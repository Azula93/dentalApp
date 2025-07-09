const { app, BrowserWindow } = require('electron');
const path = require('path');
const { spawn } = require('child_process');

let laravelProcess;
let mainWindow;

function createWindow() {
  // 1) Arranca PHP interna de Laravel
  laravelProcess = spawn(
    'php',
    ['artisan', 'serve', '--host=127.0.0.1', '--port=8000'],
    { cwd: path.resolve(__dirname, '../') } // asume electron-app/ está dentro de tu Laravel
  );
  laravelProcess.stdout.on('data', data => console.log(`[Laravel] ${data}`));
  laravelProcess.stderr.on('data', data => console.error(`[Laravel ERROR] ${data}`));

  // 2) Crea la ventana de Electron
  mainWindow = new BrowserWindow({
    width: 1200,
    height: 800,
    webPreferences: {
      nodeIntegration: false,
      contextIsolation: true
    }
  });

  mainWindow.loadURL('http://127.0.0.1:8000');
  mainWindow.on('closed', () => mainWindow = null);
}

app.whenReady().then(createWindow);

// Asegúrate de limpiar el proceso PHP al cerrar
app.on('window-all-closed', () => {
  if (laravelProcess) laravelProcess.kill();
  if (process.platform !== 'darwin') app.quit();
});

app.on('activate', () => {
  if (mainWindow === null) createWindow();
});
