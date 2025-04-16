# 🍕 PITCERNIA

**Pitcernia** to system zamówień online dla pizzerii – projekt oparty o framework Laravel, stworzony przez:

- **Maciej Płaza**
- **Jakub Passowicz**
- **Szymon Mrowiec**

---

## 🛠 Wymagane programy i ich instalacja

> ⚠️ Wymagana wersja systemu: **Windows 10 lub nowszy**

### ✅ 1. [XAMPP](https://www.apachefriends.org/index.html) – serwer PHP i MySQL
- Pobierz instalator ze strony: [https://www.apachefriends.org](https://www.apachefriends.org)
- Zainstaluj XAMPP, zaznaczając moduły: **Apache**, **MySQL**
- Uruchom **XAMPP Control Panel** i kliknij:
  - „Start” przy **Apache**
  - „Start” przy **MySQL**

### ✅ 2. [Composer](https://getcomposer.org/)
- Pobierz instalator ze strony: [https://getcomposer.org/download](https://getcomposer.org/download)
- Instalator automatycznie doda Composer do zmiennych systemowych (PATH)

### ✅ 3. [Node.js + NPM](https://nodejs.org/)
- Pobierz instalator ze strony: [https://nodejs.org](https://nodejs.org)
- Zalecana wersja: **LTS**
- Po instalacji sprawdź w terminalu:
  ```bash
  node -v
  npm -v
  ```

---

## 💻 Instalacja lokalna

Otwórz **CMD** lub **PowerShell**, a następnie wykonaj poniższe komendy:

```bash
git clone https://github.com/twoj-uzytkownik/pitcernia.git
cd pitcernia
composer install
npm install
copy .env.example .env
php artisan key:generate
```

---

## 🛢️ Konfiguracja bazy danych

1. Wejdź w przeglądarce na: http://localhost/phpmyadmin  
2. Kliknij „Nowa”, wpisz nazwę `pitcernia`, kliknij „Utwórz”  
3. W pliku `.env` ustaw:

```env
DB_DATABASE=pitcernia
DB_USERNAME=root
DB_PASSWORD=
```

4. Następnie uruchom migracje i seedery:

```bash
php artisan migrate --seed
```

---

## ✅ Uruchomienie aplikacji

Po zainstalowaniu wszystkich zależności i przygotowaniu bazy danych, wykonaj poniższe kroki:

### ▶️ 1. Zbuduj frontend

Dla wersji deweloperskiej (z auto-odświeżaniem):

```bash
npm run dev
```

Lub dla wersji produkcyjnej:

```bash
npm run build
```

---

### ▶️ 2. Uruchom serwer aplikacji

```bash
php artisan serve
```

---

### 🌐 3. Wejdź w przeglądarce pod adres:

👉 http://127.0.0.1:8000

---
