+ Layout có 2 loại :
- Loại 1 xđ content bên trong
- Loại 2 kiểu column

+ Merge layout XMl
- Mỗi module có thể có cùng file xml ví dụ
Magento-catalog và Magento-wishlist thì đều có file Catalog-product-view.xml mục đích để mỗi file của mỗi 1 module có 1 tác dụng và ý nghĩa riêng.

+ Overide 1 file XMl
- Nếu muốn orveride hẳn 1 cái theme thì sẽ khai báo
ví dụ Magento-catalog/Layout/overide/base/tên file mình cần.

- <update handle="empty"></update> :  ý nghĩa là nó như đang include nội dung của tk empty.xml