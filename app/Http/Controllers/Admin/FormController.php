<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Forms;
use App\Models\Job;
use App\Models\FormFiledsData;
use App\Models\FormFields;
use DB;
use App\Models\ContentPage;
use Collective\Html\FormFacade as Form;
use App\Models\User;
use Modules\Superadmin\App\Http\Controllers\AccountController;
use Log;
use Auth;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = __('global.forms');
        $forms = Forms::with('formField')->get();

        // Pretvorite objekte u nizove ili format pogodan za JavaScript
        $formsForJs = $forms->map(function ($form) {
            return [
                'id' => $form->id,
                'name' => $form->name,
                'data_table' => $form->data_table,
                'redirect' => $form->redirect,
                // Dodajte ostale atribute koji su vam potrebni
            ];
        });

        return view('admin.forms.index', compact('page_title', 'formsForJs'));
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
      
        // Assuming 'formField' is the correct relationship name in your FormFieldsData model
        $form = Forms::with(['formFields', 'formFields.fieldsData'])->findOrFail($id);
        $page_title = __('global.form').': '. $form->name;
    
        return view('admin.forms.show', compact('page_title', 'form'));
    }

    /**
     * Get attributes of selected form field
     */
    public function getAttr($id)
    {
        $id = myCryptie($id, 'decode');
        $field = FormFields::with('fieldsData')->findOrFail($id);
        //\Log::info($field);
        return view('admin.forms.attrform', compact('field'));
    }

    /**
     * Update fieldsdata attr settings.
     */
    public function updateFormFieldsData(Request $request)
    {
        // prepare data so that it can be stored properly in the db
        $updateData = [
            'input_id' => $request->input_id,
            'input_name' => $request->input_name,
            'is_required' => $request->is_required,
            'input_encoded' => $request->input_encoded,
            'classes' => json_encode( [
                    'groupe_div_classes' => $request->groupe_div_classes,
                    'label_classes' => $request->label_classes, 
                    'input_div_classes' => $request->input_div_classes, 
                    'input_object_classes' => $request->input_object_classes
                ]),
            'input_validation' => $request->input_validation,
            'is_disabled' => $request->is_disabled,
            'default_value' => $request->default_value,
            'input_placeholder' => $request->input_placeholder,
            'input_style' => $request->input_style,
            'info_text' => $request->info_text,
            'get_info_from' => json_encode( [
                    'get_info_from' => $request->get_info_from, 
                    'db_table' => $request->get_info_from == 'db' ? $request->db_table : null, 
                    'db_where_statement' => $request->get_info_from == 'db' ? $request->db_where_statement : null, 
                    'db_value_field' => $request->get_info_from == 'db' ? $request->db_value_field : null, 
                    'db_label_field' => $request->get_info_from == 'db' ? $request->db_label_field : null, 
                    'array' => $request->get_info_from == 'array' ? $request->array : null
                ])
        ];
        
        // update db and redirect back to the right form field
        DB::beginTransaction();
        try {
            FormFiledsData::where('id', decrypt($request->id))->update($updateData);
            DB::commit();
            return redirect()->back()->with([
                'success' => __('global.data_updated_sussesfully'),
                'fieldId' => $request->form_fields_id 
            ]); 
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'error' => __('global.data_update_error'),
                'fieldId' => $request->form_fields_id
            ]); 
        }
    }

    /**
     * Update field order
     */
    public function updateFormFieldsOrder(Request $request)
    {
        //check if data exisist in request
        if (!$request->has('data')) {
            return response()->json(['status' => 'error', 'message' => 'No data provided!']);
        }
        $data = json_decode($request->data, true);
        DB::beginTransaction();
    
        try {
            foreach ($data as $order => $encryptedId) {
                // Ovdje koristimo $encryptedId direktno jer smo već dobili čisti niz ID-ova.
                $id = decrypt($encryptedId); 
                FormFields::where('id', $id)->update(['order_by' => $order + 1]);
            }
            DB::commit();
        
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['status' => 'error', 'message' => __('global.data_update_error')]);
        }
    }

    /**
     * Get wanted form.
     */
    public function loadMyForm(Request $request)
    {
        if ($request->has('recordID')) {
            // Dekriptovanje poslatih podataka
            $recordID = decrypt($request->recordID);
            $formName = decrypt($request->formName);
            $serviceCategoryId = $request->input('service_category_id', null); 
    
            // Postavke forme za kreiranje ili uređivanje
            $formSettings['method'] = $recordID == 0 ? 'POST' : 'POST';
            $formSettings['recordID'] = $recordID;
            $formSettings['service_category_id'] = $serviceCategoryId;
            $formSettings['action'] = 'admin.form.insertData';
            $formSettings['modalForm'] = $request->modalForm ? $request->modalForm : 'no';
    
            // Kreiranje forme
            $formHtml = $this->createMyForm($formName, $formSettings);
    
            // Ako treba dodati skriveni input za 'service_category_id' direktno
            $formHtml .= "<input type='hidden' name='service_category_id' value='" . htmlspecialchars($serviceCategoryId, ENT_QUOTES) . "'>";
    
            return $formHtml;
        }
    
        return false;
    }
    
    /**
     * Create the form.
     */
    public function createMyForm( $formName, $formSettings=[], $getFormSettings=false )
    {
        // get right form
        $form = Forms::where('name', $formName)->first();

        if( isset( $form->name ) ){
            // get form fields
            $formFields = FormFields::where('form_id', $form->id)->orderBy('order_by')->get();

            $formRules = [];
            $encodedInput = [];
            $myFormFields = '';
            $i = 1;
            $x = 0;

            // get data if edit mode
            if( isset($formSettings['recordID']) && $formSettings['recordID'] > 0 ){
                if($form->data_table == 'users'){
                    $dataUser = DB::table($form->data_table)->where('id', $formSettings['recordID'])->first();
                    $dataUserInfo = DB::table('user_info')->where('user_id', $formSettings['recordID'])->first();

                    $data = (object) array_merge((array) $dataUser, (array) $dataUserInfo);
                } else {
                    $data = DB::table($form->data_table)->where('id', $formSettings['recordID'])->first();
                }
            }

            // get field settings and make the right field
            foreach ($formFields as $field) {
                $formFieldData = FormFiledsData::where('form_fields_id', $field->id)->get();
                $fieldData = $formFieldData->toArray();

                // if the getFormSettings is true, get the validation option of each field else create form
                if($getFormSettings){
                    // get validation options
                    $rule = $formFieldData[0]->is_required == 'yes' ? 'required|' : '';
                    $rule .= $formFieldData[0]->input_validation != '' ? $formFieldData[0]->input_validation.'|' : '';
                    $formRules[$formFieldData[0]->input_name] = rtrim($rule, '|');
                    // get input code types
                    $encodedInput[$formFieldData[0]->input_name] = $formFieldData[0]->input_encoded;
                } else {
                    // send value of the current field
                    $value = '';
                    $currentField = $fieldData[0]['input_name'];

                    if( isset($data->$currentField) ){
                        if( $formFieldData[0]->input_encoded == 'yes' ){
                            $value = decrypt($data->$currentField);
                        } else if( $formFieldData[0]->input_encoded == 'yes_myCryptie' ){
                            $value = myCryptie($data->$currentField, 'decode');
                        } else {
                            $value = $data->$currentField;
                        }
                    } else {
                        $value = $formFieldData[0]->default_value;
                    }

                    // check whether fields need to be grouped
                    $classes = json_decode($formFieldData[0]->classes);
                    $groupe_div_classes = $classes->groupe_div_classes ?? '';
                    $label_classes =  $classes->label_classes ?? '';
                    $input_div_classes = $classes->input_div_classes ?? '';
                    $input_object_classes = $classes->input_object_classes ?? '';
                    $fieldCounter = [];

                    if( $field->group_name == ''){
                        if( isset($myGroup) && $field->group_name != $myGroup && $x > 0){
                            $myFormFields .= '</div></div></div>';

                            $myFormFields = calcRightCol($myFormFields, $x);
                            $x = 0;
                        }

                        $myFormFields .= '<div class="'. $groupe_div_classes .'">
                                            <label class="'. $label_classes .'">'. setTranslationLabel($field->label) .'</label>
                                            <div class="'. $input_div_classes .'">';
                    } 

                    if($field->group_name != ''){
                        if( !isset($myGroup) ){
                            $myFormFields .= '  <div class="'. $groupe_div_classes .'">
                                                    <label class="col-md-3 control-label text-lg-end mb-0">'. setTranslationLabel($field->group_name) .'</label>
                                                    <div class="'. $input_div_classes .'">
                                                        <div class="row">';
                        } 

                        if( isset($myGroup) && $myGroup != $field->group_name  ){
                            $myFormFields .= '</div></div></div>';
                            $myFormFields = calcRightCol($myFormFields, $x);
                            $x = 0;
                            
                            $myFormFields .= '<div class="'. $groupe_div_classes .'">
                                                <label class="col-md-3 control-label text-lg-end mb-0">'. setTranslationLabel($field->group_name) .'</label>
                                                <div class="'. $input_div_classes .'">
                                                    <div class="row">';
                        }

                        $myFormFields .= '<div class="dynamic-col">
                                            <label class="'. $label_classes .'">'. setTranslationLabel($field->label) .'</label>';

                        $myGroup = $field->group_name;
                        $x++;
                    }

                    // get db or array settings
                    $fieldSettings = json_decode($fieldData[0]['get_info_from'], true);
                    $obtainedData = [];
                    if (isset($fieldSettings['db_table']) && !empty($fieldSettings['db_table'])) {
                        // fetch data from db
                        $query = DB::table($fieldSettings['db_table'])->select($fieldSettings['db_value_field'], $fieldSettings['db_label_field']);

                        if (!empty($fieldSettings['db_where_statement'])) {
                            $query->whereRaw($fieldSettings['db_where_statement']);
                        }

                        $obtainedData = $query->pluck($fieldSettings['db_label_field'], $fieldSettings['db_value_field'])->toArray();
                    } elseif (isset($fieldSettings['array']) && !empty($fieldSettings['array'])) {
                        $arrayString = $fieldSettings['array'];
                        $arrayPairs = explode(',', $arrayString);
                        foreach ($arrayPairs as $pair) {
                            list($key, $pair_value) = explode('=>', $pair);
                            $obtainedData[trim($key, " '\"")] = trim($pair_value, " '\"");
                        }
                    }

                    switch ($field->type) {
                        case 'text':
                            $myFormFields .= view('admin.forms.fields.text', compact('formFieldData', 'value', 'input_object_classes'));
                        break;
                        case 'password':
                            $myFormFields .= view('admin.forms.fields.password', compact('formFieldData', 'value', 'input_object_classes'));
                        break;
                        case 'select':
                            $myFormFields .= view('admin.forms.fields.select', compact('formFieldData', 'value', 'input_object_classes', 'obtainedData'));
                        break;
                        case 'image':
                            $myFormFields .= view('admin.forms.fields.image', compact('formFieldData', 'value', 'input_object_classes'));
                        break;
                        case 'checkbox':
                            $myFormFields .= view('admin.forms.fields.checkbox', compact('formFieldData', 'value', 'input_object_classes', 'obtainedData'));
                            break;
                        case 'select2':
                                $myFormFields .= view('admin.forms.fields.select2', compact('formFieldData', 'value', 'input_object_classes', 'obtainedData'));
                                break;
                        case 'textarea':
                            $myFormFields .= view('admin.forms.fields.textarea', compact('formFieldData', 'value', 'input_object_classes'));
                            break;

                        case 'wysiwyg':
                            $myFormFields .= view('admin.forms.fields.wysiwyg', compact('formFieldData', 'value', 'input_object_classes'));
                            break;

                         case 'radio':
                            $myFormFields .= view('admin.forms.fields.radio', compact('formFieldData', 'value', 'input_object_classes', 'obtainedData'));
                            break;
                        case 'colorpicker':
                            $myFormFields .= view('admin.forms.fields.colorpicker', compact('formFieldData', 'value', 'input_object_classes'));
                            break;
                        
                        case 'datepicker':
                            $myFormFields .= view('admin.forms.fields.datepicker', compact('formFieldData', 'value', 'input_object_classes'));
                            break;                  
                    }

                    if ( $fieldData[0]['info_text'] != '' ){
                        $myFormFields .= '<p class="form-info-text">'. setTranslationLabel($fieldData[0]['info_text']) .'</p>';
                    }

                    if( $field->group_name == ''){
                        $myFormFields .= '</div></div>';
                    } 
                    
                    if( isset($myGroup) && $field->group_name == $myGroup){
                        $myFormFields .= '</div>';

                        if( $i == count($formFields) ){
                            $myFormFields .= '</div></div></div>';
                            $myFormFields = calcRightCol($myFormFields, $x);
                        }
                    }

                    $i++;
                }
            }

            // if the getFormSettings is true send only validatio return
            if($getFormSettings){
                $formAttr = [
                    'name' => $form->name,
                    'data_table' => $form->data_table,
                    'redirect' => $form->redirect,
                    'rules' => $formRules,
                    'input' => $encodedInput
                ];
                return $formAttr;
            }

            // complete a complete form and return it
            $uniquekey = rand(5, 1500000000000);
            $return = '<form class="my-dynamic-form" action="'. route($formSettings['action']) .'" method="'. $formSettings['method'] .'" id="myForm-'. $uniquekey .'">';
     
            $return .= $myFormFields;
            $return .= view('admin.forms.fields.saveBtn', compact('formSettings', 'formName', 'uniquekey'));
            $return .= '</form>';
        } else {
            $return = __('global.from_not_found');
        }

        return $return;
    }

    /**
     * Insert or update data in the db.
     */
    public function insertData(Request $request)
    {


        \Log::info($request);
        if( $request->formName != '' ){
            $formName = decrypt($request->formName);
            $recordID = decrypt($request->recordID);
        
            // check the validation
            $formAttr = $this->createMyForm($formName, [], true);
            $validatedData = $request->validate($formAttr['rules']);
  
            // save data in db
            $data = [];
      
            foreach($request->request as $key=>$value) {
                if( !in_array($key, ['_method', '_token', 'formName', 'recordID', 'password_confirmation']) ){
                    // check if dat must be encrypted
                    if($formAttr['input'][$key] == 'yes'){
                        $input = encrypt($value);
                    } else if($formAttr['input'][$key] == 'yes_myCryptie'){
                        $input = myCryptie($value);
                    } else {
                        $input = $value;
                    }

                    $data[$key] = ($key == 'password' ? bcrypt($input) : $input);
                }
            }



            // some forms require data optimization because they are stored in several tables
            if($formName == 'Super admin accounts'){
                $return = (new AccountController)->storeSuperAdmin($data, $recordID);
                return $return;
            } elseif($formName == 'Add app') {
                // Add app form
                $appController = new AppController;
                $return = $appController->storeApp($data, $recordID);
                return $return;
            }

            $formsForJobs = ['Rohbau Mauerarbeiten', 'Forma2', 'Forma3'];
        
            if (!Auth::check()) {
                // Ako korisnik nije ulogovan, sačuvajte podatke u sesiji i preusmjerite na prijavu/registraciju
                session(['form_data' => $request->all()]);
                session()->save();
                Log::info('Preusmjeravanje na email-check');
                return redirect()->route('email-check');
  
            }
           
            // Provjera da li je trenutna forma jedna od formi koje trebaju biti obrađene posebno
            if (in_array($formName, $formsForJobs)) {
                $serviceCategoryId = session('service_category_id', null);
                // Priprema podataka za 'jobs' tabelu
                $jobData = [
                    'title' => $data['title'], // Pretpostavljamo da postoji 'title' u $data
                    'description' => $data['description'], // Pretpostavljamo da postoji 'description' u $data
                    'service_category_id' => $serviceCategoryId,  // Pretpostavljamo da postoji 'service_category_id' u $data
                    'is_active' => 0, // Postavite 'is_active' na 0
                    'status' => 'pending',
                    'featured_image' => $data['featured_image'] ?? null, 
                    'image_gallery' => $data['image_gallery'] ?? null, 
                ];

                // dd($jobData);
    
            
                // Dodajte 'user_id' ako je korisnik ulogovan
                if (Auth::check()) {
                    $jobData['user_id'] = Auth::id();
                }
            
                // Spremite ostale podatke u 'additional_details'
                $additionalDetails = array_diff_key($data, array_flip(['title', 'description', 'service_category_id', 'featured_image', 'image_gallery']));
                if (!empty($additionalDetails)) {
                    $jobData['additional_details'] = json_encode($additionalDetails);
                }
            
                // Kreirajte i sačuvajte novi 'Job'
                $job = new Job($jobData);
                $job->save();
            
                return redirect()->route('my-jobs')->with('success', __('global.data_add_sussesfully'));
            }
            

            //if is form name Add page
            if ($formName == 'Add Page') {

                Log::info($data);
                if (!isset($data['slug']) && isset($data['title'])) {
                    $data['slug'] = Str::slug($data['title']);
                }

                DB::beginTransaction();
                try {
                    if ($recordID > 0) {
                        // update existing page
                        $contentPage = ContentPage::find($recordID);
                        $contentPage->update($data);
                    } else {
                        // Create new page
                        $contentPage = ContentPage::create($data);
                    }
            
                    
                    // Pretpostavka je da se ID kategorije šalje u formi kao 'category_id'
                    $contentPage->category()->sync($request->input('category_id'));
            
                    DB::commit();
                    return response()->json(['status' => 'success', 'message' => __('global.data_add_sussesfully')]);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
                }
            }
            

            if($recordID > 0){
                // edit mode
                DB::beginTransaction();
                try {
                    // update mode
                    DB::table($formAttr['data_table'])->where('id', $recordID)->update($data);
                    DB::commit();

                    // return some feedback
                    return response()->json(['status' => 'success', 'message' => __('global.data_updated_sussesfully')]);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->json(['status' => 'error', 'message' => __('global.data_update_error')]);
                }
            } else {
                // insert mode
                DB::beginTransaction();
                try {
                    // insert data
                    $new_id = DB::table($formAttr['data_table'])->insertGetId($data);
                    DB::commit();

                    // If there are exceptions such as writing data to another DB table, enter them here
                    if( $formAttr['data_table'] == 'form_fields' ){
                        $this->formInsertExceptions($formAttr['data_table'], $new_id, $formAttr, $data);
                    }
                    
                    // return some feedback
                    return response()->json(['status' => 'success', 'message' => __('global.data_add_sussesfully')]);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->json(['status' => 'error', 'message' => __('global.data_update_error')]);
                }
            }
        } else {
            return response()->json(['status' => 'error', 'message' => __('global.from_save_url_not_found')]);
        }
    }

    // Exceptions which are needed when inserting some data
    public function formInsertExceptions($dbTable, $new_id, $formAttr, $data)
    {
        // create form_fields_data row for this field
        if( $dbTable == 'form_fields' ){
            $insertTable = 'form_fileds_data';
            $insertData = [
                'form_fields_id' => $new_id,
                'classes' => '{"groupe_div_classes":"form-group row align-items-center pt-3 pb-3","label_classes":"col-md-3 control-label text-lg-end mb-0","input_div_classes":"col-md-8","input_object_classes":"form-control form-control-modern"}'
            ];
        }

        // write data in the db
        if(isset($insertTable) && isset($insertData) ){
            DB::beginTransaction();
            try {
                $new_id = DB::table($insertTable)->insertGetId($insertData);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
            }
        }
    }

    /**
     * Remove the specified form field from storage.
     */
    public function destroyForm(Request $request)
    {
        $id = decrypt($request->id);
        if($id > 0){
            DB::beginTransaction();
            try {
                $formFields = FormFields::where('form_id', $id)->orderBy('order_by')->get();
                foreach($formFields as $field){
                    DB::table('form_fileds_data')->where('form_fields_id', $field->id)->delete();
                }
                DB::table('form_fields')->where('form_id', $id)->delete();
                DB::table('forms')->where('id', $id)->delete();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
            }
        }
        return back();
    }

    /**
     * Copy the specified form field data from storage.
     */
    public function formCopy($id)
    {
        dd($id);
        $id = decrypt($id);
        if($id > 0){
            DB::beginTransaction();
            try {
                // get form to copy
                $form = Forms::where('id', $id)->first();
                // insert copied form info
                $newFormID = DB::table('forms')->insertGetId([
                    'name' => $form->name.'-'.__('global.copy'),
                    'data_table' => $form->data_table,
                    'redirect' => $form->redirect
                ]);
                
                // get form fields of copied form
                $formFields = FormFields::where('form_id', $form->id)->orderBy('order_by')->get();
                foreach($formFields as $field){
                    // insert copied form fields
                    $newFormFieldsID = DB::table('form_fields')->insertGetId([
                        'form_id' => $newFormID,
                        'label' => $field->label,
                        'type' => $field->type,
                        'group_name' => $field->group_name,
                        'order_by' => $field->order_by,
                    ]);

                    // get form fields data
                    $formFieldData = FormFiledsData::where('form_fields_id', $field->id)->get();
                    foreach($formFieldData as $fieldData){
                        // insert copied form fields data
                        $newFormFieldsDataID = DB::table('form_fileds_data')->insertGetId([
                            'form_fields_id' => $newFormFieldsID,
                            'input_id' => $fieldData->input_id,
                            'input_name' => $fieldData->input_name,
                            'is_required' => $fieldData->is_required,
                            'input_encoded' => $fieldData->input_encoded,
                            'classes' => $fieldData->classes,
                            'input_validation' => $fieldData->input_validation,
                            'is_disabled' => $fieldData->is_disabled,
                            'default_value' => $fieldData->default_value,
                            'input_placeholder' => $fieldData->input_placeholder,
                            'input_style' => $fieldData->input_style,
                            'info_text' => $fieldData->info_text,
                            'get_info_from' => $fieldData->get_info_from,
                        ]);
                    }
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
            }
        }
        return back();
    }

    /**
     * Remove the specified form field from storage.
     */
    public function destroyFormFields(Request $request)
    {
        $id = decrypt($request->id);
        if($id > 0){
            DB::beginTransaction();
            try {
                DB::table('form_fields')->where('id', $id)->delete();
                DB::table('form_fileds_data')->where('form_fields_id', $id)->delete();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
            }
        }
        return back();
    }
}