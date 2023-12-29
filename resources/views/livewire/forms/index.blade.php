<div x-data="invoiceList">
    <!-- Ostatak vašeg HTML koda -->

    <div class="invoice-table">
        <table id="myTable" class="whitespace-nowrap">
            <!-- Definicija zaglavlja tabele -->
            <tbody>
                <!-- Dinamičko generisanje redova tabele -->
                <template x-for="item in items" :key="item.id">
                    <tr>
                        <!-- Definicija kolona za svaki red -->
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('invoiceList', () => ({
                items: [], // Ovdje ćete držati svoje podatke
                init() {
                    // Ovdje možete učitati podatke
                    fetch('/api/your-endpoint')
                        .then((response) => response.json())
                        .then((data) => {
                            this.items = data; // Pretpostavljamo da `data` sadrži niz objekata
                        })
                        .catch((error) => {
                            console.error('Error fetching data: ', error);
                        });

                    // Ovdje možete inicijalizovati DataTables ili bilo koju drugu logiku
                },
                // Dodajte sve ostale metode i propertije koji su vam potrebni
            }));
        });
    </script>
</div>
