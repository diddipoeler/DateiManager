"use strict";

document.addEventListener("DOMContentLoaded", () => {

    console.log("DateiManager gestartet");

    document
        .querySelectorAll(".file-card")
        .forEach(card => {

            card.addEventListener("mouseenter", () => {

                card.classList.add("shadow");

            });

            card.addEventListener("mouseleave", () => {

                card.classList.remove("shadow");

            });

        });

});