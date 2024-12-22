# Test Task: Distribution Service API

## Objective:
Build a **Distribution Service** that distributes an amount of money among multiple investors based on their respective investment rates.

There are only 3 endpoints.

The service can only distribute integer values, which means amounts must be rounded down to the nearest integer.

Any remaining value resulting from the rounding process should be tracked and stored as rounding information.

The service calculates and stores distributions based on the given amount and investment rates.

Please use PHP ^8.2 or later and Laravel ^10.0.
You can use any libraries, tools or techonologies you think are necessary.
Feel free to improve or extend the service based on their own judgment.

---

## API Requirements:

### 1. Endpoint: POST `/distribution`
Accepts the following JSON payload:
```json
{
  "amount": 1000,
  "rates": {
    "investment_a": 0.5,
    "investment_b": 0.3,
    "investment_c": 0.2
  }
}
```
Validation Rules:
- amount: Required, must be a positive integer.
- rates: Required, must be an object where the sum of the values equals 1.

Processing:
- Calculate the raw distributed amount for each investment as **amount * rate.**
- Round each investment’s amount down to the previous integer.
- Calculate the total of the rounded amounts and compare it with the original amount:
- The remainder is the adjustment.
- Ensure that the sum of the rounded amounts equals the original amount.
- Save the distribution and not distributed remainder.

Response:
```json
{
  "id": 1,
  "amount": 1000,
  "distribution": {
    "investment_a": 500,
    "investment_b": 300,
    "investment_c": 200
  }
}
```

### 2. Endpoint: GET /distribution

Retrieve all distributions.

Response:
```json
[
  {
    "id": 1,
    "amount": 1000,
    "distribution": {
      "investment_a": 500,
      "investment_b": 300,
      "investment_c": 200
    }
  },
  {
    "id": 2,
    "amount": 999,
    "distribution": {
      "investment_a": 499,
      "investment_b": 299,
      "investment_c": 199
    }
  }
]
```

### 3. Endpoint: GET /distribution/roundings

Retrieve rounding details for all distributions.

Response:
```json
[
  {
    "id": 1,
    "roundings": {
      "investment_a": 0,
      "investment_b": 0,
      "investment_c": 0
    },
    "total": 0.0
  },
  {
    "id": 2,
    "roundings": {
      "investment_a": 0.5,
      "investment_b": 0.7,
      "investment_c": 0.8
    },
    "total": 2
  }
]
```
### Deliverables
1. A Laravel project with:
    - Storage for distributions and roundings (MySQL or what you prefer).
    - Functional API endpoints as described.
    - Couple of tests.
    - Instructions to run and test the project.
2. Testing (Optional but Recommended):
    - Include unit and/or feature tests for the endpoints, business logic, and rounding adjustments.

### Evaluation Criteria:
1. Correctness:
    - API works as described.
    - Validation, calculations, rounding, and adjustments are accurate.
2. Code Quality:
    - Clean and maintainable code.
3. Creativity and Problem Solving:
    - Thoughtful improvements or extensions to the service.
4. Documentation:
    - Clear setup and usage instructions.
