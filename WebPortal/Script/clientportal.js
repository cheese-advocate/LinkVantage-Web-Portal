var textTruncate;

document.addEventListener( "DOMContentLoaded", () => {
    let wrapper = document.querySelector( ".query-description" );
    let options = {
        
        callback: function( isTruncated ) {
            var toggle = document.getElementById("query-toggle-show");
            toggle.style.display = "inline";
        },
        /* Function invoked after truncating the text.
         Inside this function, "this" refers to the wrapper. */
        
        ellipsis: "\u2026",
        /* The text to add as ellipsis. */

        height: 50,
        /* The (max-)height for the wrapper:
        null: measure the CSS (max-)height ones;
        a number: sets a specific height in pixels;
        "watch": re-measures the CSS (max-)height in the "watch". */

        keep: null,
        /* Query selector for elements to keep after the ellipsis. */

        tolerance: 0,
        /* Deviation for the measured wrapper height. */

        truncate: "word",
        /* How to truncate the text: "node", "word" or "letter". */

        watch: "true"
        /* Whether to update the ellipsis:
        true: Monitors the wrapper width and height;
        "window": Monitors the window width and height. */
    };
   textTruncate = new Dotdotdot( wrapper, options );
   
   textTruncate.truncate();
});

function toggleShow(){
    var toggle = document.getElementById("query-toggle-show");
    if(toggle.innerHTML === "Show more"){
        textTruncate.API.restore();
        toggle.innerHTML = "Show less";        
    } else if(toggle.innerHTML === "Show less"){
        textTruncate.API.truncate();
        toggle.innerHTML = "Show more";
    }
}


