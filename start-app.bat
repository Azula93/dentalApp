@echo off
REM -> Nos movemos al directorio del proyecto
cd /d "C:\wamp64\www\app-dentista"
REM -> Arrancamos el servidor integrado de Laravel en el puerto 8000
start "" php artisan serve --host=127.0.0.1 --port=8000
REM -> Esperamos 2 s para que el servidor esté arriba
timeout /t 2 /nobreak >nul
REM -> Abrimos el navegador apuntando a la URL de la app
start "" "http://127.0.0.1:8000"
