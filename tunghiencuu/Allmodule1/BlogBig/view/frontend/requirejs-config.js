var config = {
    map: {
        "*": {
            "owlslider": "js/owl.carousel"
        }
    },
    paths: {
        "owlslider": "js/owl.carousel" // thao tác định nghĩa(và đường dẫn) cho thư viện của ta là gì.
    },
    "shim": {
        "js/owl.carousel": ["jquery"], // cái này khống chế là cái owl.carousel.js muốn đc nạp thì phải nạp
        // thư viện jquery trước.
    }
};