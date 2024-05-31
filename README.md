# Vulnerable-web
Web structure with 6 vulnerables: 
1. SQLi injection Sleep (Done)
2. File Upload (Done)
3. Insecure Derialization 
4. IDOR 
5. Access Control
6. XSS (Done)

## 1/ Sign in, Sign Up Page (Done)
**-> SQL Injection time based(Done):**
+ Payload SQL Injection: ' OR '1'='1 into Password inpt, username canbe anything
+ Payload Timebased: using burpsuite to attack:
{base}' and (select*from(select(sleep(20)))a)-- 

## 2/ Home Page: Shopping Table (Done)
+ Render upload product onto page

## 3/ User Page: Upload img, change email
**-> File Upload: Web shell upload via Content-Type restriction bypass (Done)**
+ Payload: Shell.php 
- Level 1: With vulnerable code, can upload easy.
- Level 2: With more secure code, just use burp suite and race condition file upload.
**-> Insecure Derialization**

**-> IDOR**
+ Payload: Scan and find secret file by path: /admin/secret.txt

## 4. Admin Panel: Upload product, delete user
**-> XSS: inject when upload product**
-> Payload: <script>alert('XSS Attack!');</script>
Render HTML

**-> Access Control : Bypass to get control delete user** 
-> Payload: /delete_user.php?user_id = 5