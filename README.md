# API do wypożyczania książek

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