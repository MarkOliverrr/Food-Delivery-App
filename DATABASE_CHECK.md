# ✅ DATABASE STRUCTURE - OK NA!

## All Database Tables Ready:

1. **admins** ✅
   - adm_id (Primary Key)
   - username
   - password
   - email
   - code
   - timestamps

2. **res_categories** ✅
   - c_id (Primary Key)
   - c_name
   - timestamps

3. **restaurants** ✅
   - rs_id (Primary Key)
   - c_id (Foreign Key → res_categories)
   - title, email, phone, url
   - o_hr, c_hr, o_days
   - address, image
   - timestamps

4. **dishes** ✅
   - d_id (Primary Key)
   - rs_id (Foreign Key → restaurants)
   - title, slogan
   - price
   - img
   - timestamps

5. **users** ✅
   - u_id (Primary Key)
   - username, email (unique)
   - f_name, l_name
   - phone, password
   - address
   - status
   - timestamps

6. **users_orders** ✅
   - o_id (Primary Key)
   - u_id (Foreign Key → users)
   - title, quantity
   - price
   - status
   - timestamps

7. **remarks** ✅
   - id (Primary Key)
   - frm_id
   - status, remark
   - remarkDate

## Foreign Key Relationships:

- restaurants.c_id → res_categories.c_id
- dishes.rs_id → restaurants.rs_id  
- users_orders.u_id → users.u_id

## ✅ All Good! Ready to migrate!


