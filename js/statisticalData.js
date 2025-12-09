// --- Graphique des ventes ---
// (NE SURTOUT PAS mettre getContext en haut → ça causait les erreurs)
function ViewDataSale() {

    const Context = document.getElementById('lineChartSale');

    if (!Context) {
        console.error("Le canvas lineChartSale est introuvable !");
        return;
    }

    const ctx = Context.getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labelSale,
            datasets: [{
                label: 'Ventes Mensuelles',
                data: valueSale,
                borderColor: 'rgba(0, 13, 255, 1)',
                backgroundColor: 'rgba(0, 187, 255, 0.75)',
                tension: 0.4,
                fill: true,
                pointRadius: 5
            }]
        }
    });
}



// --- Graphique des achats ---
function ViewDataPurchase() {

    const ContextPurchase = document.getElementById('lineChartPurchase');

    if (!ContextPurchase) {
        console.error("Le canvas lineChartPurchase est introuvable !");
        return;
    }

    const ctx = ContextPurchase.getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labelPurchase,
            datasets: [{
                label: 'Achat Mensuels',
                data: valuePurchase,
                borderColor: 'rgba(0, 13, 255, 1)',
                backgroundColor: 'rgba(0, 187, 255, 0.75)',
                tension: 0.4,
                fill: true,
                pointRadius: 5
            }]
        }
    });
}
