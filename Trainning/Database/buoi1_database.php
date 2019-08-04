Có 5 bảng chính liên quan admin.
+ http://prntscr.com/oeg5lm sẽ được lưu vào 2 bảng này khi mà admin cấp cao nhất phân quyền cho các admin có cấp nhỏ nhất.

+ eav_attribute nó sẽ liệt kê ra hết các attribute (phân biệt khác nhau bởi cái entity_type_id).
+ Ngoài ra các bảng eav_int là lưu các giá trị dạng int, varchar....


+ Khi tạo ra 1 attribute thì phải tìm cách đưa dữ liệu vào bảng ...index

Use un Layered Navigation để là yes sẽ tự động vào bảng index(chỗ attribute).

Mục đích để tránh làm giảm tốc độ lọc sản phẩm.

+ Catalog Price Rule

- thì nó sẽ vào các bảng CatalogRule.(tạo các đợt giảm giá cho sản phẩm)
- Khi tạo cái Catalog Price Rule thì nó sẽ tìm sẵn luôn các sản phẩm thỏa mãn cái đó thì sẽ cho luôn các sản phẩm vào bảng  : catalogrule_product

+ Catalog_Product_Link nó sẽ lưu các sản phẩm liên quan tới nhau.

+ Block,Page thì sẽ lưu vào được các bảng cms_block, và cms_page, Ngoài ra nó có các bảng cms_block_store, và cms_page_store thì nó sẽ lưu các block tương ứng vs store nào, hay page tương ứng vs store nào.


+ cron_schedule : để set khoảng thời gian để chạy 1 chương trình.
+ design change :  nếu dùng theme nhưng k đc thì phải check trong bảng này xem có đặt đk cho theme hoạt động từ ngày bn tới ngày bn k.(Content->schedule)


+ Customer : customer_grid_flat bảng này là bảng lưu trữ mọi thông tin của khách hàng.
- Nếu như lưu mà bảng chưa reset thì phải rendirex thì ms cập nhật đc.

+ Report xem sản phẩm có bn lượt view, hoặc compare sản phẩm...

+ sale_order lưu các thông tin liên quan tới order, nếu muốn xóa order của khách thì vào đây xóa, và xóa luôn ở bảng flat nữa.

+ bảng theme. nếu như custom file layout vào my theme mà nó  chạy thì vào bảng này để đổi cái type = 0.

+ url_rewrite là bảng chỉnh có thể chỉnh sửa url cho đẹp.