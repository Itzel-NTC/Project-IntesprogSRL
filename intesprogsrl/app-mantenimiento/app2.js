function loadImage(url, cacheBuster) {
    return new Promise(resolve => {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', url + `?${cacheBuster}`, true);
        xhr.responseType = "blob";
        xhr.onload = function (e) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const res = event.target.result;
                resolve(res);
            }
            const file = this.response;
            reader.readAsDataURL(file);
        }
        xhr.send();
    });
}

let signaturePad = null;

window.addEventListener('load', async () => {

    const canvas = document.querySelector("canvas");
    canvas.height = canvas.offsetHeight;
    canvas.width = canvas.offsetWidth;

    signaturePad = new SignaturePad(canvas, {});

    const form = document.querySelector('form');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const clienteSelect = document.getElementById('cliente');
        const cliente = clienteSelect.options[clienteSelect.selectedIndex].text;
        const nombreMantenimiento = document.getElementById('nombre_mantenimiento').value;
        const fiscalServicio = document.getElementById('fiscal_servicio').value;
        const servicio = document.getElementById('servicio').value;
        const direccion = document.getElementById('direccion').value;
        const numEquipo = document.getElementById('num_equipo').value;
        const marcaEquipo = document.getElementById('marca_equipo').value;
        const modeloEquipo = document.getElementById('modelo_equipo').value;
        const numSerie = document.getElementById('num_serie').value;
        const numTubos = document.getElementById('num_tubos').value;
        const ubicacion = document.getElementById('ubicacion').value;
        const nivel = document.getElementById('nivel').value;
        const fechaMantenimiento = document.getElementById('fecha_mantenimiento').value;
        const tecnico = document.getElementById('tecnico').value;
        const observaciones = document.getElementById('observaciones').value;

        // Añadir un valor de tiempo único para evitar el almacenamiento en caché de la imagen
        const image = await loadImage("../hoja-img/plantilla_intesprogSRL_20.png", Date.now());
        const signatureImage = signaturePad.toDataURL();

        const pdf = new jsPDF('p', 'pt', 'letter');

        pdf.addImage(image, 'PNG', 0, 0, 612, 792);
        pdf.addImage(signatureImage, 'PNG', 115, 725, 100, 45);

        const subactividadesDiv = document.getElementById('contenedor_subactividades');
        const subactividadesInputs = subactividadesDiv.querySelectorAll('input');
        
        const espacioEntreSubactividades = 18;
        
        for (let i = 0; i < subactividadesInputs.length; i++) {
            const valor = subactividadesInputs[i].value;
        
            // Solo añadir al PDF si hay una descripción
            if (valor.trim() !== '') {
                pdf.setFont('helvetica', 'normal');
                pdf.setFontSize(8);
                pdf.text(`${valor}`, 65, 335 + i * espacioEntreSubactividades, { baseline: 'middle' });
            }
        }


        for (let i = 1; i <= 20; i++) {
            const obsCheckboxSi = document.getElementById(`obs-si${i}`);
            const obsCheckboxNo = document.getElementById(`obs-no${i}`);
    
            if (obsCheckboxSi.checked) {
                // Respuesta positiva
                pdf.setFont('helvetica', 'normal');
                pdf.setFontSize(8);
                pdf.text(`o`, 515, 317 + i * espacioEntreSubactividades, { baseline: 'middle' });
            } else if (obsCheckboxNo.checked) {

                pdf.setTextColor(255);
                pdf.setFont('helvetica', 'bold');
                pdf.setFontSize(8);
                pdf.text(`x`, 515, 317 + i * espacioEntreSubactividades, { baseline: 'middle' });
                pdf.setTextColor(0);
                pdf.setFont('helvetica', 'normal');
            }
        }


        pdf.setFont('helvetica', 'bold');
        pdf.setFontSize(14);
        pdf.text(nombreMantenimiento, 230, 60, { baseline: 'middle' });
        pdf.setFont('helvetica', 'normal');
        pdf.setFontSize(8);
        pdf.text(cliente, 200, 153, { baseline: 'middle' });
        const date = new Date();
        pdf.text(date.getUTCDate().toString(), 120, 780, { baseline: 'middle' });
        pdf.text((date.getUTCMonth() + 1).toString(), 145, 780, { baseline: 'middle' });
        pdf.text(date.getUTCFullYear().toString(), 175, 780, { baseline: 'middle' });

        pdf.text(fiscalServicio, 200, 172, { baseline: 'middle' });
        pdf.text(servicio, 200, 190, { baseline: 'middle' });
        pdf.text(direccion, 200, 210, { baseline: 'middle' });
        pdf.text(numEquipo, 150, 250, { baseline: 'middle' });
        pdf.text(marcaEquipo, 150, 269, { baseline: 'middle' });
        pdf.text(modeloEquipo, 150, 288, { baseline: 'middle' });
        pdf.text(numSerie, 150, 305, { baseline: 'middle' });
        pdf.text(numTubos, 415, 250, { baseline: 'middle' });
        pdf.text(ubicacion, 415, 269, { baseline: 'middle' });
        pdf.text(nivel, 415, 288, { baseline: 'middle' });
        pdf.text(fechaMantenimiento, 415, 305, { baseline: 'middle' });
        pdf.text(tecnico, 110, 723, { baseline: 'middle' });
        pdf.text(observaciones, 250, 725, { baseline: 'middle', maxWidth: 800 });

        pdf.save("intesprog-srl.pdf");
    });

    document.getElementById('cliente').addEventListener('change', function() {
        var selectedClientId = this.value;

        // Realizar la solicitud AJAX
        fetch('obtener_info_cliente.php?id=' + selectedClientId)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la solicitud AJAX');
                }
                return response.json();
            })
            .then(data => {
                console.log('Datos del cliente:', data);

                // Rellenar los campos con la información del cliente
                document.getElementById('fiscal_servicio').value = data.fiscal_servicio;
                document.getElementById('direccion').value = data.direccion;
            })
            .catch(error => console.error('Error al obtener información del cliente:', error));
    });
});