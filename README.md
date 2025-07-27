# 📚 Sistema di Gestione Biblioteca - Laravel

Un'applicazione web per la gestione di libri, copie e utenti, sviluppata in **Laravel 10**. Permette ad amministratori di creare, modificare e visualizzare libri e copie, e agli utenti di navigare il catalogo.

---

## 🚀 Funzionalità principali

- ✅ CRUD Libri (con copertina e categorie)
- ✅ CRUD Copie (barcode univoco generato automaticamente)
- ✅ Validazioni lato server
- ✅ Ricerca e filtro per titoli e barcode
- ✅ Autenticazione utenti con ruoli (admin / utente semplice)
- ✅ Visualizzazione utenti registrati (solo admin)
- ✅ Interfaccia responsive con stile verde "biblioteca"

---

## 🛠️ Requisiti

- PHP ≥ 8.1
- Composer
- MySQL o MariaDB
- Node.js e npm (per asset frontend, facoltativo)

---

## ⚙️ Installazione

1. **Clona il progetto:**

   ```bash
   git clone https://github.com/tuo-utente/progetto-biblioteca.git
   cd progetto-biblioteca
### 1. Installa le dipendenze PHP del progetto (richiede Composer installato)
composer install

### 2. Crea il file di configurazione dell'ambiente partendo dall'esempio
cp .env.example .env

### 3. Modifica il file .env con le tue credenziali database
 Esempio:
 DB_DATABASE=nome_database
 DB_USERNAME=nome_utente
 DB_PASSWORD=password_utente

### 4. Genera la chiave dell'applicazione Laravel
php artisan key:generate

### 5. Esegui le migrazioni per creare le tabelle nel database
php artisan migrate

### (Opzionale) Se hai seeders, puoi popolare il DB con dati di esempio
php artisan db:seed

### 6. (Facoltativo) Se usi Laravel Mix/Vite, installa e compila gli asset frontend
npm install
npm run dev

### 7. Avvia il server di sviluppo Laravel
php artisan serve

### Ora puoi accedere al progetto visitando http://localhost:8000

👤 Credenziali di accesso
Ruolo	Email	Password
Admin	admin@admin.com	password
Utente	user@user.com	password

Puoi modificare o creare nuovi utenti nel database.

📂 Struttura del progetto
app/Models – Modelli Laravel (Book, Copy, User)

app/Http/Controllers – Controller (BookController, CopyController, ecc.)

resources/views – Blade templates per le pagine

routes/web.php – Rotte dell'app

public/storage/covers – Copertine dei libri

database/migrations – Struttura del database

🧾 Note utili
Le copertine vengono salvate in storage/app/public/covers e accessibili da public/storage/covers.

Usa php artisan storage:link per creare il symbolic link alla cartella storage.

📄 Licenza
Progetto a scopo didattico - uso libero.

yaml
Copia
Modifica

---

### ✅ Fatto!  
Ora salva questo file come `README.md` nella root del tuo progetto e sei pronto per consegnare.

Se vuoi che ti prepari anche il `.gitignore` o il `composer.json`, chiedi pure!
