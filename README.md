## webservice usage

URL: http://127.0.0.1:8000/api/matrix/multiply/

Method: GET

Body:
{
    "matrix1":[
        [3, 55, 2],
        [3, 0, 4]
    ],
    "matrix2":[
        [2, 3],
        [9, 0],
        [0, 4]
    ]
}

Result:
{
    "result": [
        [
            "SG",
            "Q"
        ],
        [
            "F",
            "Y"
        ]
    ],
    "success": true
}
