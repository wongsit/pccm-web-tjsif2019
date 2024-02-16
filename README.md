# pccm-web-tjsif2019
เว็บไซต์งาน Thailand Japan Student ICT Fair 2019 กลุ่มโรงเรียนโรงเรียนวิทยาศาสตร์จุฬาภรณราชวิทยาลัย

โปรแกรม tjsif2019 นี้จัดทำขึ้นเพื่อใช้ในการจัดงาน tj-sif 2019 จัดที่ โรงเรียนวิทยาศาสตร์ ุฬาภรณราชวิทยาลัย มุกดาหาร ระหว่างวันที่ 20-22 ธันวาคม 2562 
- โปรแกรมนี้แจกจ่ายให้กับโรงเรียนที่จะเป็นเจ้าภาพในปีต่อๆไป เพื่อนำไปใช้ โดยไม่มีค่าใช้จ่ายใดๆทั้งสิ้น
- ผู้ที่นำไปพัฒนาต่อ นอกเหนือจากที่ผมได้ทำไว้แล้ว ท่านจะต้องรับผิดชอบความถูกต้องโปรแกรมเอง
- หากมีข้อสงสัยในโปรแกรม ติดต่อได้ที่ นายขรรค์ชัย วงศ์สิทธิ์ เจ้าหน้าที่ ICT โรงเรียนวิทยาศาสตร์ ุฬาภรณราชวิทยาลัย มุกดาหาร  email: griffinics@gmail.com

# Server Required
- Xampp Version 7.3.12
- Apache/2.4.41
- PHP version: 7.3.12
- Mysql version 5.0.12

# การติดตั้ง

1. คัดลอกโฟลเดอร์ tjsif2019 แล้วนำไปวางในเซอร์เวอร์ที่ต้องการ ในโฟล์เดอร์ที่เก็บไฟล์สำหรับบริการเว็บไซต์ เช่น www หรือ  htdocs
2. ปรับแต่งไฟล์ดังนี้
- ไฟล์ config.php	ในโฟล์เดอร์  tjsif2019\application\config  โดยแก้ไขบรรทัดที่ 26 
- ไฟล์  database.php	ในโฟล์เดอร์  tjsif2019\application\config	โดยแก้ไขบรรทัดที่ 79-80  แก้ไข username และ password
- ไฟล์  email.php	ในโฟล์เดอร์  tjsif2019\application\configโดยแก้ไขบรรทัดที่ 9-10 79-80  แก้ไข username และ password

3. สร้างฐานข้อมูลชื่อ pcshsm_tjsif2019 แล้วทำการ Import file ฐานข้อมูล Database จากไฟล์ pcshsm_tjsif2019.sql เข้าในโปรแกรมจัดการฐานข้อมูล phpmyadmin

เรียบร้อยสำหรับการติดตั้ง


# การตั้งค่า เปิด - ปิด วันที่ ลงทะเบียน

ให้ตั้งวันที่ ใน ฐานข้อมูล ตาราง tb_site เพื่อกำหนดการ ลงทะเบียน และอับโหลดไฟล์

# รหัสผ่านผู้ใช้คนแรก(กรุณาอย่าลบทิ้งเพราะจะมีผลกับโปรแกรม)
- username : w.khanchai@pccm.ac.th
- password : tj12345678

**ต้องการเพิ่ม user ให้ไป invite ในเมนู Member

