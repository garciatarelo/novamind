const ctx = document.getElementById('chartIngresos');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'
        ,'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 
        'Diciembre'],
      datasets: [{
        label: 'Ganancias por mes',
        data: [300000, 235708, 280369, 500014, 274258, 374635,
            100000, 740708, 377486, 207814, 743971, 478268,
        ],
        borderWidth: 1,
        backgroundColor: '#66FCF1',
        borderColor: 'black'
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });



  const ctxCategorias = document.getElementById('chartCategorias').getContext('2d');
  new Chart(ctxCategorias, {
      type: 'pie',
      data: {
          labels: ['Fundamentos de la tecnología', 'Productividad digital', 'Ciberseguridad', 
            'Redes', 'Programación', 'Inteligencia artificial'],
          datasets: [{
              data: [40, 25, 20, 15, 12, 7], // Porcentajes
              backgroundColor: ['#1F2833', '#45A29E', 'lightgrey', '#66FCF1' , 'grey', '#b9fafa', '#7d7b77']
          }]
      },
      options: {
          responsive: true,
          plugins: {
              legend: {
                  position: 'top'
              }
          }
      }
  });