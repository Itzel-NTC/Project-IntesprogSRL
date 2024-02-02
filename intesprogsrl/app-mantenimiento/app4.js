function loadImage(url) {
    return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.responseType = 'blob';

        xhr.onload = function (e) {
            if (this.status === 200) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    const res = event.target.result;
                    resolve(res);
                };
                const file = this.response;
                reader.readAsDataURL(file);
            } else {
                reject(new Error(`Failed to load image: ${url}`));
            }
        };

        xhr.onerror = function () {
            reject(new Error(`Network error while trying to load image: ${url}`));
        };

        xhr.send();
    });
}

async function resizeImage(imageData, maxWidth, maxHeight) {
    return new Promise((resolve, reject) => {
        const img = new Image();
        img.src = imageData;

        img.onload = () => {
            // Calcular las nuevas dimensiones manteniendo las proporciones
            let newWidth, newHeight;

            if (img.width > maxWidth || img.height > maxHeight) {
                const aspectRatio = img.width / img.height;

                newWidth = Math.min(img.width, maxWidth);
                newHeight = newWidth / aspectRatio;

                if (newHeight > maxHeight) {
                    newHeight = maxHeight;
                    newWidth = newHeight * aspectRatio;
                }
            } else {
                // La imagen ya es más pequeña que las dimensiones máximas
                newWidth = img.width;
                newHeight = img.height;
            }

            // Crear un lienzo temporal para redimensionar la imagen
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            canvas.width = newWidth;
            canvas.height = newHeight;

            // Dibujar la imagen redimensionada en el lienzo
            ctx.drawImage(img, 0, 0, newWidth, newHeight);

            // Obtener la imagen redimensionada en formato de datos
            const resizedImageData = canvas.toDataURL('image/jpeg'); // Puedes ajustar el formato según tus necesidades

            resolve(resizedImageData);
        };

        img.onerror = () => {
            reject(new Error('Error al cargar la imagen para redimensionar.'));
        };
    });
}

let signaturePad = null;

window.addEventListener('load', async () => {
    const canvas = document.querySelector("canvas");
    canvas.height = canvas.offsetHeight;
    canvas.width = canvas.offsetWidth;

    signaturePad = new SignaturePad(canvas, {});

    const form = document.querySelector('#form');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const actividadSelect = document.getElementById('actividad');
        const actividad = actividadSelect.options[actividadSelect.selectedIndex].text;

        const subactividadesDiv = document.getElementById('contenedor_subactividades');
        const subactividadesSelects = subactividadesDiv.querySelectorAll('select');
        const descripcionImagenes = [];

        subactividadesSelects.forEach((select, index) => {
            const descripcion = select.options[select.selectedIndex].text;
            descripcionImagenes.push({ index: index + 1, descripcion });
        });

        const tecnico = document.getElementById('tecnico').value;
        const observaciones = document.getElementById('observaciones').value;
        const otrosTrabajos = document.getElementById('otrosTrabajos').value;

       
        const inputFoto11 = document.getElementById('foto11');
        const fotoFile11 = inputFoto11.files[0];
        const inputFoto22 = document.getElementById('foto22');
        const fotoFile22 = inputFoto22.files[0];
        const inputFoto33 = document.getElementById('foto33');
        const fotoFile33 = inputFoto33.files[0];
        const inputFoto4 = document.getElementById('foto4');
        const fotoFile4 = inputFoto4.files[0];
        const inputFoto5 = document.getElementById('foto5');
        const fotoFile5 = inputFoto5.files[0];
        const inputFoto6 = document.getElementById('foto6');
        const fotoFile6 = inputFoto6.files[0];
        const inputFoto7 = document.getElementById('foto7');
        const fotoFile7 = inputFoto7.files[0];
        const inputFoto8 = document.getElementById('foto8');
        const fotoFile8 = inputFoto8.files[0];
        const inputFoto9 = document.getElementById('foto9');
        const fotoFile9 = inputFoto9.files[0];
        const inputFoto = document.getElementById('foto');
        const fotoFile = inputFoto.files[0];
        const inputFoto2 = document.getElementById('foto2');
        const fotoFile2 = inputFoto2.files[0];
        const inputFoto3 = document.getElementById('foto3');
        const fotoFile3 = inputFoto3.files[0];


        const image = await loadImage("../hoja-img/PLANTILLA_FOTOGRAFICO.png", Date.now());
        const signatureImage = signaturePad.toDataURL();

        const pdf = new jsPDF('p', 'pt', 'letter');
        pdf.addImage(image, 'PNG', 0, 0, 612, 792);
        pdf.addImage(signatureImage, 'PNG', 115, 720, 100, 45);
        pdf.setFont('helvetica', 'normal');
        pdf.setFontSize(8);

        const date = new Date();
        pdf.text(date.getUTCDate().toString(), 120, 766, { baseline: 'middle' });
        pdf.text((date.getUTCMonth() + 1).toString(), 145, 766, { baseline: 'middle' });
        pdf.text(date.getUTCFullYear().toString(), 175, 766, { baseline: 'middle' });
        pdf.text(tecnico, 110, 710, { baseline: 'middle' });
        pdf.text(observaciones, 250, 715, { baseline: 'middle', maxWidth: 800 });

        const espacioEntreSubactividades = 140;

        descripcionImagenes.forEach(({ descripcion }, index) => {
            if (descripcion.trim() !== '') {
                pdf.setFont('helvetica', 'bold');
                pdf.setTextColor(255, 255, 255);
                pdf.setFontSize(8);
                pdf.text(descripcion, 65, 137 + index * espacioEntreSubactividades, { baseline: 'middle' });
            }
        });

        pdf.setFont('helvetica', 'bold');
        pdf.setTextColor(255, 255, 255);
        pdf.setFontSize(8);
        pdf.text(`- ${otrosTrabajos}`, 65, 135 + espacioEntreSubactividades * 3, { baseline: 'middle' });


        // subactividad 1
        if (fotoFile11) {
            const fotoDataURL11 = await loadImage(URL.createObjectURL(fotoFile11));
            const resizedFotoDataURL11 = await resizeImage(fotoDataURL11, 215, 140);
            pdf.addImage(resizedFotoDataURL11, 'JPEG', 60, 145);
        }
        if (fotoFile22) {
            const fotoDataURL22 = await loadImage(URL.createObjectURL(fotoFile22));
            const resizedFotoDataURL22 = await resizeImage(fotoDataURL22, 215, 140);
            pdf.addImage(resizedFotoDataURL22, 'JPEG', 230, 145);
        }
        if (fotoFile33) {
            const fotoDataURL33 = await loadImage(URL.createObjectURL(fotoFile33));
            const resizedFotoDataURL33 = await resizeImage(fotoDataURL33, 215, 140);
            pdf.addImage(resizedFotoDataURL33, 'JPEG', 400, 145);
        }
        // subactividad 2
        if (fotoFile4) {
            const fotoDataURL4 = await loadImage(URL.createObjectURL(fotoFile4));
            const resizedFotoDataURL4 = await resizeImage(fotoDataURL4, 165, 140);
            pdf.addImage(resizedFotoDataURL4, 'JPEG', 60, 285);
        }
        if (fotoFile5) {
            const fotoDataURL5 = await loadImage(URL.createObjectURL(fotoFile5));
            const resizedFotoDataURL5 = await resizeImage(fotoDataURL5, 165, 140);
            pdf.addImage(resizedFotoDataURL5, 'JPEG', 185, 285);
        }
        if (fotoFile6) {
            const fotoDataURL6 = await loadImage(URL.createObjectURL(fotoFile6));
            const resizedFotoDataURL6 = await resizeImage(fotoDataURL6, 165, 140);
            pdf.addImage(resizedFotoDataURL6, 'JPEG', 310, 285);
        }
        if (fotoFile7) {
            const fotoDataURL7 = await loadImage(URL.createObjectURL(fotoFile7));
            const resizedFotoDataURL7 = await resizeImage(fotoDataURL7, 165, 140);
            pdf.addImage(resizedFotoDataURL7, 'JPEG', 443, 285);
        }
        // subactividad 3
        if (fotoFile8) {
            const fotoDataURL8 = await loadImage(URL.createObjectURL(fotoFile8));
            const resizedFotoDataURL8 = await resizeImage(fotoDataURL8, 215, 140);
            pdf.addImage(resizedFotoDataURL8, 'JPEG', 150, 425);
        }

        if (fotoFile9) {
            const fotoDataURL9 = await loadImage(URL.createObjectURL(fotoFile9));
            const resizedFotoDataURL9 = await resizeImage(fotoDataURL9, 215, 140);
            pdf.addImage(resizedFotoDataURL9, 'JPEG', 350, 425);
        }
        // observaciones
        if (fotoFile) {
            const fotoDataURL = await loadImage(URL.createObjectURL(fotoFile));
            const resizedFotoDataURL = await resizeImage(fotoDataURL, 215, 140);
            pdf.addImage(resizedFotoDataURL, 'JPEG', 60, 565);
        }
        if (fotoFile2) {
            const fotoDataURL2 = await loadImage(URL.createObjectURL(fotoFile2));
            const resizedFotoDataURL2 = await resizeImage(fotoDataURL2, 215, 140);
            pdf.addImage(resizedFotoDataURL2, 'JPEG', 230, 565);
        }
        if (fotoFile3) {
            const fotoDataURL3 = await loadImage(URL.createObjectURL(fotoFile3));
            const resizedFotoDataURL3 = await resizeImage(fotoDataURL3, 215, 140);
            pdf.addImage(resizedFotoDataURL3, 'JPEG', 400, 565);
        }
        pdf.save("intesprog-srl-img.pdf");
    });
});



