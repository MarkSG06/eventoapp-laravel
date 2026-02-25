<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cámara</title>
    @vite(['resources/js/camera.js'])
    <script src="https://unpkg.com/monaco-editor@0.47.0/min/vs/loader.js"></script>
</head>
<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    html,
    body {
        overflow: hidden;
        height: 100vh;
        width: 100vw;
        background-color: black;
    }

    video {
        height: 100%;
        width: 100%;
        object-fit: cover;

    }

    canvas {
        display: none;
    }

    .buttons {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 2rem;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        gap: 3rem;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
    }

    .buttons button {
        background-color: transparent;
        border: none;
        cursor: pointer;
        color: #fff;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: transform 0.2s;
    }

    .buttons button:active {
        transform: scale(0.95);
    }

    #tomarFoto svg {
        color: #fff;
        background-color: rgba(255, 255, 255, 0.2);
        border: 4px solid #fff;
        border-radius: 50%;
        padding: 1rem;
        height: 80px;
        width: 80px;
    }

    #tomarFoto:hover svg {
        background-color: rgba(255, 255, 255, 0.4);
    }

    #gallery svg,
    #settings svg {
        height: 40px;
        width: 40px;
        opacity: 0.8;
    }

    #gallery span,
    #settings span {
        font-size: 0.8rem;
        margin-top: 5px;
        opacity: 0.8;
    }

    /* Loading Overlay */
    #loading {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        display: none;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        z-index: 2000;
        color: white;
    }

    .spinner {
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top: 4px solid #fff;
        width: 40px;
        height: 40px;
        -webkit-animation: spin 1s linear infinite;
        /* Safari */
        animation: spin 1s linear infinite;
        margin-bottom: 20px;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    #ticketJson {
        position: absolute;
        top: 0;
        left: 0;
        padding: 2rem;
        margin: auto;
        width: 40%;
        height: 100vh;
        background-color: #1a1a1a;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 2000;
        color: white;
    }

    #ticketJson div#ticketEditor {
        width: 100%;
        height: 100%;
        font-size: 14px;
        background: #111;
        color: #00ff9c;
        border: 1px solid #333;
        padding: 12px;
        border-radius: 8px;
        resize: none;
    }

    #ticketJson div#ticketEditor::-webkit-scrollbar {
        width: 8px;
    }

    #ticketJson div#ticketEditor::-webkit-scrollbar-track {
        background: #111;
    }

    #ticketJson div#ticketEditor::-webkit-scrollbar-thumb {
        background: #333;
    }

    #ticketJson div#ticketEditor::-webkit-scrollbar-thumb:hover {
        background: #555;
        cursor: grab;
    }

    #ticketJson div#ticketEditor::-webkit-scrollbar-thumb:active {
        background: #014109;
        cursor: grabbing;
    }

    #ticketJson.active {
        display: none;
    }


    #ticketEditor {
        width: 100%;
        height: calc(100% - 70px);
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #333;
    }

    #guardar {
        position: absolute;
        top: 0;
        right: 0;
        margin-top: 3rem;
        margin-right: 3rem;
        background-color: transparent;
        fill: #fff;
        border: none;
        cursor: pointer;
    }

    #guardar:hover {
        fill: #00ff9c;
    }

    #guardar svg {
        padding: 0;
        height: 40px;
        width: auto;
    }
</style>

<body>
    <div id="loading">
        <div class="spinner"></div>
        <p>Procesando imagen...</p>
    </div>

    <div class="buttons">
        <button id="settings">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="m9.25 22l-.4-3.2q-.325-.125-.612-.3t-.563-.375L4.7 19.375l-2.75-4.75l2.575-1.95Q4.5 12.5 4.5 12.338v-.675q0-.163.025-.338L1.95 9.375l2.75-4.75l2.975 1.25q.275-.2.575-.375t.6-.3l.4-3.2h5.5l.4 3.2q.325.125.613.3t.562.375l2.975-1.25l2.75 4.75l-2.575 1.95q.025.175.025.338v.674q0 .163-.05.338l2.575 1.95l-2.75 4.75l-2.95-1.25q-.275.2-.575.375t-.6.3l-.4 3.2zm2.8-6.5q1.45 0 2.475-1.025T15.55 12t-1.025-2.475T12.05 8.5q-1.475 0-2.488 1.025T8.55 12t1.013 2.475T12.05 15.5" />
            </svg>
            <span>Ajustes</span>
        </button>
        <button id="tomarFoto">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <circle cx="256" cy="272" r="64" fill="currentColor" />
                <path fill="currentColor"
                    d="M456 144h-83c-3 0-6.72-1.94-9.62-5L336.1 96.2C325 80 320 80 302 80h-92c-18 0-24 0-34.07 16.21L148.62 139c-2.22 2.42-5.34 5-8.62 5v-16a8 8 0 0 0-8-8H92a8 8 0 0 0-8 8v16H56a24 24 0 0 0-24 24v240a24 24 0 0 0 24 24h400a24 24 0 0 0 24-24V168a24 24 0 0 0-24-24M260.51 367.9a96 96 0 1 1 91.39-91.39a96.11 96.11 0 0 1-91.39 91.39" />
            </svg>
        </button>
        <button id="gallery">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path fill="currentColor" d="M18 8a2 2 0 1 1-4 0a2 2 0 0 1 4 0" />
                <path fill="currentColor" fill-rule="evenodd"
                    d="M11.943 1.25h.114c2.309 0 4.118 0 5.53.19c1.444.194 2.584.6 3.479 1.494c.895.895 1.3 2.035 1.494 3.48c.19 1.411.19 3.22.19 5.529v.088c0 1.909 0 3.471-.104 4.743c-.104 1.28-.317 2.347-.795 3.235q-.314.586-.785 1.057c-.895.895-2.035 1.3-3.48 1.494c-1.411.19-3.22.19-5.529.19h-.114c-2.309 0-4.118 0-5.53-.19c-1.444-.194-2.584-.6-3.479-1.494c-.793-.793-1.203-1.78-1.42-3.006c-.215-1.203-.254-2.7-.262-4.558Q1.25 12.792 1.25 12v-.058c0-2.309 0-4.118.19-5.53c.194-1.444.6-2.584 1.494-3.479c.895-.895 2.035-1.3 3.48-1.494c1.411-.19 3.22-.19 5.529-.19m-5.33 1.676c-1.278.172-2.049.5-2.618 1.069c-.57.57-.897 1.34-1.069 2.619c-.174 1.3-.176 3.008-.176 5.386v.844l1.001-.876a2.3 2.3 0 0 1 3.141.104l4.29 4.29a2 2 0 0 0 2.564.222l.298-.21a3 3 0 0 1 3.732.225l2.83 2.547c.286-.598.455-1.384.545-2.493c.098-1.205.099-2.707.099-4.653c0-2.378-.002-4.086-.176-5.386c-.172-1.279-.5-2.05-1.069-2.62c-.57-.569-1.34-.896-2.619-1.068c-1.3-.174-3.008-.176-5.386-.176s-4.086.002-5.386.176"
                    clip-rule="evenodd" />
            </svg>
            <span>Galería</span>
        </button>
    </div>

    <video id="video" autoplay playsinline></video>
    <canvas id="canvas"></canvas>
    <div class="json">
        <div id="ticketJson" class="active">
            <div id="ticketEditor"></div>
            <button id="guardar">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M18.1716 1C18.702 1 19.2107 1.21071 19.5858 1.58579L22.4142 4.41421C22.7893 4.78929 23 5.29799 23 5.82843V20C23 21.6569 21.6569 23 20 23H4C2.34315 23 1 21.6569 1 20V4C1 2.34315 2.34315 1 4 1H18.1716ZM4 3C3.44772 3 3 3.44772 3 4V20C3 20.5523 3.44772 21 4 21L5 21L5 15C5 13.3431 6.34315 12 8 12L16 12C17.6569 12 19 13.3431 19 15V21H20C20.5523 21 21 20.5523 21 20V6.82843C21 6.29799 20.7893 5.78929 20.4142 5.41421L18.5858 3.58579C18.2107 3.21071 17.702 3 17.1716 3H17V5C17 6.65685 15.6569 8 14 8H10C8.34315 8 7 6.65685 7 5V3H4ZM17 21V15C17 14.4477 16.5523 14 16 14L8 14C7.44772 14 7 14.4477 7 15L7 21L17 21ZM9 3H15V5C15 5.55228 14.5523 6 14 6H10C9.44772 6 9 5.55228 9 5V3Z">
                        </path>
                    </g>
                </svg>
            </button>
        </div>

    </div>
</body>

</html>