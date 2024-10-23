# API do wypożyczania książek

## Kroki do uruchomienia

1. **Klonowanie repozytorium**
   Otwórz terminal i sklonuj repozytorium projektu:
   ```bash
   git clone https://github.com/samk1r0/mizzox-test-task
   ```

2. **Przejdź do katalogu projektu**
   ```bash
   cd mizzox-test-task
   ```

3. **Instalacja zależności**
   Zainstaluj wszystkie wymagane pakiety:
   ```bash
   composer install
   ```

4. **Konfiguracja bazy danych**
   Skopiuj plik `.env.example` do `.env`:
   ```bash
   cp .env.example .env
   ```

5. **Migracja bazy danych**
   Wykonaj migracje:
   ```bash
   php artisan migrate
   ```

6. **Seedowanie bazy danych**
   Aby wypełnić bazę danych przykładowymi danymi, uruchom polecenie:
   ```bash
   php artisan db:seed
   ```

7. **Uruchomienie serwera**
   Uruchom serwer lokalnie:
   ```bash
   php artisan serve
   ```

8. **Testowanie API**
   Po uruchomieniu serwera, API powinno być dostępne pod adresem `http://localhost:8000`.

## Dodatkowe informacje
- Aby uruchomić testy funkcjonalne, użyj polecenia:
  ```bash
  php artisan test
  ```
- Plik `.env.example` zawiera przykładowe konfiguracje, które są podobne do tych używanych przy komunikacji z bazą danych.

## Endpointy

### 1. Listowanie książek
- **GET /books**
  - Zwraca listę książek z paginacją (20 książek na stronę).
  - Możliwość wyszukiwania po nazwie książki, autorze oraz imieniu i nazwisku klienta.
  - Opcjonalne parametry:
    - `title`: nazwa książki
    - `author`: autor książki
    - `name`: imię klienta
    - `surname`: nazwisko klienta

### 2. Szczegóły książki
- **GET /books/{id}**
  - Zwraca szczegóły książki: nazwa, autor, rok wydania, wydawnictwo, status wypożyczenia oraz osoba wypożyczająca.
  - Wymaga podania `id` książki w ścieżce URL.

### 3. Lista klientów
- **GET /clients**
  - Zwraca listę klientów.

### 4. Szczegóły klienta
- **GET /clients/{id}**
  - Zwraca szczegóły klienta oraz listę wypożyczonych książek bez paginacji.
  - Wymaga podania `id` klienta w ścieżce URL.

### 5. Dodawanie klienta
- **POST /clients**
  - Dodaje nowego klienta.
  - Wymaga podania `name` i `surname` w treści żądania.

### 6. Usuwanie klienta
- **DELETE /clients/{$id}**
  - Usuwa klienta.

### 7. Wypożyczanie i oddawanie książek
- **PUT /books/rent**
  - Zwraca status wypożyczenia książki.
  - Wymaga podania `book_id` i `client_id` w treści żądania.