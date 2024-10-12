
// $('#btn-enviar-correo').on('click', function () {
//     obtener_datos_correos();
// });

// function obtener_datos_correos() {
//     // loading(true); // Puedes mostrar un indicador de carga aquí si lo necesitas
//     $.ajax({
//         url: "exe.php", // Archivo que procesará la solicitud
//         type: "POST", // Método de envío
//         dataType: "JSON", // Esperamos respuesta en formato JSON
//         data: {
//             run: 'empleados', // Parámetro 'run'
//             action: 'obtenerempleados_correos' // Parámetro 'action'
//         },
//         success: function (data) {
//             // loading(false); // Quitar el indicador de carga
//             if (data.error) {
//                 alert('Error: ' + data.error); // Mostrar mensaje de error si existe
//             } else {
//                 contenedro_correo = data.correo;
//                 // alert("se envio el correo: " + contenedro_correo);
//                 enviar_correo(contenedro_correo);
//             }


//         },
//         error: function (jqXHR, textStatus, errorThrown) {
//             // Manejo de errores
//             if (jqXHR.status === 0) {
//                 alert('No conectado: Verifica la red.');
//             } else if (jqXHR.status == 404) {
//                 alert('Página no encontrada [404].');
//             } else if (jqXHR.status == 500) {
//                 alert('Error interno del servidor [500].');
//             } else if (textStatus === 'parsererror') {
//                 console.log(jqXHR.responseText);
//                 alert('Error al analizar JSON.');
//             } else if (textStatus === 'timeout') {
//                 alert('Error de tiempo de espera.');
//             } else if (textStatus === 'abort') {
//                 alert('Solicitud Ajax abortada.');
//             } else {
//                 console.log('Error no capturado: ' + jqXHR.responseText);
//             }
//         }
//     });
// }


// function enviar_correo(contenedro_correo) {
//     // Obtener los correos del formulario
//     // var toEmail = document.getElementById('toEmail').value;
//     // var ccEmail = document.getElementById('ccEmail').value; // Este es opcional
//     // var from_Message = document.getElementById('from_message').value; // Este es opcional

//     var templateParams = {
//         toEmail: contenedro_correo,
//         from_name: 'Cesar',
//         cc_email: 'sistemas@megacomercial.co', // Agregar el correo en copia
//         message: 'este es un correo probando desde base de datos'
//     };

//     // Enviar el correo usando EmailJS
//     emailjs.send('service_cyxzs99', 'template_ea43mm9', templateParams)
//         .then(function (response) {
//             alert('Correo enviado con éxito!' + contenedro_correo, response.status, response.text);
//         }, function (error) {
//             alert('Error al enviar el correo: ' + JSON.stringify(error));
//         });
// }




