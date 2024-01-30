
@extends('frontend.layouts.front')
@section('content')
<!-- ============================ Page Title Start================================== -->
<div class="hero-banner full bg-cover side-effect h-100" style="background-color:rgb(49, 138, 185)">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-10">
                
                <h2 class="ipt-title mb-3">Wie funktioniert My Work?</h2>
                <p class="text-light mb-4 text-black">Stellen Sie schnell und unkompliziert Ihren Auftrag bei MyHammer ein. Wir stellen Ihnen mehrere qualifizierte Handwerker, die Ihnen kostenlos und unverbindlich ein Abgebot zusenden. Wählen Sie das Angebot mit dem besten Preis-Leistungs-Verhältnis aus und vergeben Sie den Auftrag.</p>
       
            </div>
            <div class="col-lg-6 col-md-4 col-sm-6">
                <div class="achievement-wrap">
                    <div class="achievement-content">
                        <div class="ache-icon white"><img src="{{ asset('frontend/img/sofa.png')}}" height="200" alt=""></div>
                    </div>
                </div>
            </div>
      
        </div>
    </div>
</div>
<!-- ============================ Page Title End ================================== -->

<section class="gray-light">
    <div class="container">
    
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9">
                <div class="sec-heading">
                    <h2>Wählen Sie den passenden <span class="theme-cl-2">Handwerker</span></h2>
                    <p>Die von Ihnen ausgewählten Handwerker erhalten Ihre Kontaktdaten, um Ihnen ein Angebot zu unterbreiten. Sie können diese auch direkt per E-Mail oder Telefon kontaktieren..</p>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="achievement-wrap">
                    <div class="achievement-content">
                        <div class="ache-icon purple"><i class="ti-agenda"></i></div>
                        <h4><span class="cto">Ihr Profil</span></h4>
                        <p>Passende Handwerker stellen sich vor und erklären in ihrem Angebot, warum sie für den Auftrag geeignet sind.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="achievement-wrap">
                    <div class="achievement-content">
                        <div class="ache-icon green"><i class="ti-money"></i></div>
                        <h4><span class="cto">Preisangaben</span></h4>
                        <p>Gegebenenfalls unterbreiten Ihnen unsere Handwerker auch einen Kostenvoranschlag, basierend auf dem Arbeitsaufwand, den Materialkosten, usw. So können Sie ganz einfach einen Handwerker auswählen, der das beste Preis-Leistungs-Verhältnis hat und zu Ihren Anforderungen passt.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="achievement-wrap">
                    <div class="achievement-content">
                        <div class="ache-icon yellow"><i class="ti-star"></i></div>
                        <h4><span class="cto">Bewertungen</span></h4>
                        <p>Für jeden Auftrag, den unsere Handwerker ausführen, können Auftraggeber eine Bewertung abgeben. So können Sie Ihre Wahl auch auf der Grundlage der Bewertungen von anderen treffen.</p>
                    </div>
                </div>
            </div>
       
            
        </div>
            
    </div>
</section>


<section>
    <div class="container">
        <div class="row align-items-center">
                    
            <!-- Single Box -->
            <div class="col-lg-6 col-md-6 col-sm-12">
                <img src="{{ asset('frontend/img/about.png') }}" alt="" class="img-fluid">
            </div>
            
            <!-- Single Box -->
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="about-captione">
                    <h6 class="text-blue">Über My Work</h6>
                    <h2>Kurze Geschichte über den  My Work<br>Dienstleistungsservice.</h2>
                    <p>Workoo verbindet Sie in wenigen einfachen Schritten mit qualifizierten Handwerkern in Ihrer Nähe. Je detaillierter Sie Ihren Auftrag beschreiben, desto präzisere Angebote können Sie von den Handwerkern erwarten.</p>
                    <ul class="lists-3 mt-3">
                        <li><strong>Stellen Sie Ihren Auftrag ein:</strong> Definieren Sie Ihren Bedarf und die Handwerker stellen sich mit ihren Angeboten vor.</li>
                        <li><strong>Erhalten Sie Angebote:</strong> Lehnen Sie sich zurück und erhalten Sie Angebote direkt per E-Mail.</li>
                        <li><strong>Wählen Sie den passenden Handwerker:</strong> Treffen Sie Ihre Wahl basierend auf den Angeboten und Bewertungen.</li>
                    </ul>
                    <a href="#" class="btn dark-2 btn-rounded">Mehr erfahren</a>
                </div>
            </div>
            
        </div>
            
    </div>
</section>





@endsection