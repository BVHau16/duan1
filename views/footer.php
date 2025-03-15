<footer>
     <div class="about-us">
         <div class="logo-footer">
             <img src="img/fahasa-logo.webp" alt="">
         </div>
         <div class="information">
             <div class="infor-us">
                 <h4>Thông tin</h4>
                 <p><i class="fa-solid fa-location-dot"></i> P.Xuân Phương, Nam Tử Liêm, HN</p>
                 <p><i class="fa-solid fa-phone"></i> 1900636467</p>
                 <p><i class="fa-regular fa-envelope"></i> cskh@fahasa.com.vn</p>
             </div>
             <div class="infor-us">
                 <h4>Dịch vụ</h4>
                 <p>Điều khoản sử dụng</p>
                 <p>Chính sách bảo mật</p>
                 <p>Giới thiệu Fahasa</p>
                 <p>Hệ thống-trung tâm</p>
             </div>
             <div class="infor-us">
                 <h4>Hỗ trợ</h4>
                 <p>Chính sách đổi-trả</p>
                 <p>Chính sách bảo hành</p>
                 <p>Chính sách vận chuyển</p>
                 <p>Chính sách khách sỉ</p>
             </div>
         </div>
     </div>

     <script>
         //lấy button
         search = document.getElementById('search');
         keyword = document.getElementById('keyword')
         //viết sự kiện click cho nút search
         search.addEventListener('click', function() {
             searchProduct();
         })

         keyword.addEventListener('keydown', function(e) {
             if (e.key == 'Enter') {
                 searchProduct();
                 e.preventDefault()
             }
         })
         //hàm seach()
         function searchProduct() {
             window.location = "index.php?ctl=search&keyword=" + keyword.value;
         }
     </script>

 </footer>

 </body>

 </html>