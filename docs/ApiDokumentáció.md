# Postman API Dokumentáció – Foglalások és Felhasználókezelés

**Alap URL:** `{{base_url}}`

### Header példa:

```
Authorization: Bearer {token}
Accept: application/json
Content-Type: application/json
```


## Változók a kollekcióban:

| Változó | Érték |
|---------|-------|
| base_url | http://localhost/reservationKisujSanctumBearer/public/api |
| id | 1 |
## 1. Teszt – Hello Endpoint

- **Endpoint:** `/hello`
- **HTTP metódus:** `GET`
- **Leírás:** Egyszerű teszt endpoint, ellenőrzi, hogy az API elérhető.

### Kérés példa:

```http
GET {{base_url}}/hello
```

### Válasz példa (200 OK):

```json
{
    "message": "Hello world!"
}
```

## 2. Felhasználó regisztráció

- **Endpoint:** `/register`
- **HTTP metódus:** `POST`
- **Leírás:** Új felhasználó létrehozása

### Kérés Body (JSON):

```json
{
    "name": "Patrik",
    "email": "patrik@gmail.com",
    "password": "Nemtudom20",
    "password_confirmation": "Nemtudom20"
}
```

### Válasz példa (201 Created):

```json
{
    "message": "User registered successfully",
    "user": {
        "id": 1,
        "name": "Patrik",
        "email": "patrik@gmail.com",
        "created_at": "2025-11-24T09:00:00.000000Z",
        "updated_at": "2025-11-24T09:00:00.000000Z"
    }
}
```

## 3. Bejelentkezés

- **Endpoint:** `/login`
- **HTTP metódus:** `POST`
- **Leírás:** Felhasználó bejelentkezése és Bearer token generálása

### Kérés Body (JSON):

```json
{
    "email": "patrik@gmail.com",
    "password": "Nemtudom20"
}
```

### Válasz példa (200 OK):

```json
{
    "access_token": "2|GQKKHAdOHkS1x7OOHULgdUQEzWbupd8pSsBCT5im5fdc7412",
    "token_type": "Bearer"
}
```

### Hiba (401 Unauthorized):

```json
{
    "message": "The provided credentials are incorrect."
}
```

## 4. Kijelentkezés

- **Endpoint:** `/logout`
- **HTTP metódus:** `POST`
- **Leírás:** Token törlése, kijelentkezés

### Header:

```
Authorization: Bearer {token}
Accept: application/json
Content-Type: application/json
```

### Kérés Body (JSON):

```json
{
    "email": "teszerele@gmail.com",
    "password": "IgenNem_20"
}
```

### Válasz példa (200 OK):

```json
{
    "message": "Successfully logged out"
}
```

## 5. Összes foglalás lekérése

- **Endpoint:** `/reservations`
- **HTTP metódus:** `GET`
- **Leírás:** Lekéri az összes foglalást. Csak admin tokennel működik minden foglalásra, normál tokennel csak saját foglalások.

### Header:

```
Authorization: Bearer {token}
Accept: application/json
Content-Type: application/json
```

### Válasz példa (200 OK):

```json
[
    {
        "id": 1,
        "user_id": 2,
        "reservation_time": "2025-10-02 18:43:30",
        "guests": 4,
        "note": "Lorem ipsum dolor sit amet"
    }
]
```

## 6. Egy foglalás lekérése

- **Endpoint:** `/reservations/{id}`
- **HTTP metódus:** `GET`
- **Leírás:** Egy foglalás részleteinek lekérése

### Header:

```
Authorization: Bearer {token}
Accept: application/json
Content-Type: application/json
```

### Példa:

```http
GET {{base_url}}/reservations/2
```

### Válasz példa (200 OK):

```json
{
    "id": 2,
    "user_id": 1,
    "reservation_time": "2025-10-02 18:43:30",
    "guests": 4,
    "note": "Lorem ipsum dolor sit amet"
}
```

## 7. Új foglalás létrehozása

- **Endpoint:** `/reservations`
- **HTTP metódus:** `POST`
- **Leírás:** Új foglalás létrehozása

### Header:

```
Authorization: Bearer {token}
Accept: application/json
Content-Type: application/json
```

### Kérés Body (JSON):

```json
{
    "reservation_time": "2025-10-02 18:43:30",
    "guests": 4,
    "note": "Lorem ipsum dolor sit amet"
}
```

### Válasz példa (201 Created):

```json
{
    "id": 11,
    "user_id": 1,
    "reservation_time": "2025-10-02 18:43:30",
    "guests": 4,
    "note": "valami de az nagyon"
}
```

## 8. Foglalás frissítése (PUT/PATCH)

- **Endpoint:** `/reservations/{id}`
- **HTTP metódus:** `PUT` vagy `PATCH`
- **Leírás:** Foglalás módosítása

### Header:

```
Authorization: Bearer {token}
Accept: application/json
Content-Type: application/json
```

### Kérés Body (JSON):

```json
{
    "reservation_time": "2025-10-02 18:43:30",
    "guests": 4,
    "note": "Lorem ipsum dolor sit amet"
}
```

### Válasz példa (200 OK):

```json
{
    "id": 11,
    "user_id": 1,
    "reservation_time": "2025-10-02 18:43:30",
    "guests": 4,
    "note": "Lorem ipsum dolor sit amet"
}
```

## 9. Foglalás törlése

- **Endpoint:** `/reservations/{id}`
- **HTTP metódus:** `DELETE`
- **Leírás:** Foglalás törlése

### Header:

```
Authorization: Bearer {token}
Accept: application/json
Content-Type: application/json
```

### Példa:

```http
DELETE {{base_url}}/reservations/11
```

### Válasz példa (200 OK):

```json
{
    "message": "Foglalás törölve."
}
```