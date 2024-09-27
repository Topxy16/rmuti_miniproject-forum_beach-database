<!DOCTYPE html>
<html lang="en">
<!-- maketechstuff.com -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Text On Hover | maketechstuff.com</title>
    <link rel="stylesheet" href="index.css">
</head>

<style>
    * {
        padding: 0px;
        margin: 0px;
        font-family: sans-serif;
    }

    body {
        width: 100%;
        height: 100vh;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    li {
        background-color: red;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .slider {
        display: flex;
        flex-direction: column;
        width: max-content;
        pointer-events: none;
    }

    span {
        font-size: 40px;
        padding: 15px 50px;
        color: #fff;
    }

    li {
        background-color: red;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        position: relative;
    }

    .slider {
        position: absolute;
        top: 0px;
        display: flex;
        flex-direction: column;
        width: max-content;
        pointer-events: none;
        transition: 0.5s cubic-bezier(0.50, -0.600, 0.200, 1.6);
    }
</style>



<body>

    <button type="button" class="button">

        <div class="slider">
            <span class="span1">Next</span>
            <span class="span2">Previous</span>
        </div>

    </button>
    <script>
        let li = document.querySelector(".li");
        let slider = document.querySelector(".slider");
        let i = document.querySelector(".i");
        let span2 = document.querySelector(".span2");

        li.style.width = span1.clientWidth + "px";
        li.style.height = span1.clientHeight + "px";

        li.onmouseover = function() {
            slider.style.top = "-" + span1.clientHeight + "px";
        }
        li.onmouseout = function() {
            slider.style.top = "0px";
        }

    </script>

</body>

</html>