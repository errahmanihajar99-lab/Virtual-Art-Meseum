// Crea un rastro de puntos de colores que sigue al cursor.

document.addEventListener("mousemove", function(event) {
        const trace = document.createElement("div");

        trace.classList.add("trace");

        trace.style.left = event.clientX + "px";
        trace.style.top = event.clientY + "px";

        // elegir color aleatori de la paleta
        const couleurs = ["#C9EEF2", "#F2CA80", "#F4756D"];
        trace.style.backgroundColor =
        couleurs[Math.floor(Math.random() * couleurs.length)];

        document.body.appendChild(trace);

        // borrar la "trace"
        setTimeout(function() {
            trace.remove();
        }, 500);
    });