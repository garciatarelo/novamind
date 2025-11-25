/*CONVERTIR DIA, MES Y AÑO EN FORMATO YYY/MMM/DDD*/
document.querySelector('form').addEventListener('submit', function (e) {
    e.preventDefault(); // Evitar el envío por defecto para pruebas
    
    // Captura los valores seleccionados
    const day = document.getElementById('day').value;
    const month = document.getElementById('month').value;
    const year = document.getElementById('year').value;
  
    // Construir la fecha en formato YYYY-MM-DD
    const birthDate = `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
  
    console.log('Fecha de nacimiento:', birthDate);
  
    // Aquí envías la fecha al servidor (con fetch o AJAX)
    // Ejemplo usando fetch:
    fetch('addUser.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `birthDate=${encodeURIComponent(birthDate)}`
    }).then(response => response.text())
      .then(data => console.log(data));
  });
  
  
  
  