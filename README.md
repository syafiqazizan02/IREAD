# IREAD

# Project Background - Library Management System for Primary School (integrated with Biometric Fingerprint)
Library Management System for Primary School (I-READ) integrated with biometric device is developed for Sekolah Kebangsaan Parit Melana (SKPM) library. This system consists of three (3) users which are admin, librarian and member. Thus, this system provides modules such manage setting, manage librarian, manage member, manage issue and view generated report. In mange setting module there are setting for penalty rate and book limit of each members. Manage librarian module are consist of create new librarian account and update status of librarian account active or inactive while manage member consist of register a new member which are a student or teacher and view the information of member. Besides that, manage issue module are about to make book transactions easily whenever a members wants to borrow or return from the library. In this modules also show the penalty charged for the each members that returning book late. Generated report modules are about total book borrowed, number member had been registered and total penalty had been charged. 
 
 For the registration, admin must register the librarian and librarian will register the member. As a admin, they need to set up the position information based on new position of the member before register into the system. This is to make sure the user is registered according to the position that created. Thus, admin can manage the book category for managing the new book added following the category and shelf location while admin also can generate barcode of book and report the book that damage. Furthermore, there are book transaction including borrow and return the book. The biometric device will be used because to make sure that the borrower and the information in the system is same. This system provides Nilam review and achievement for Nilam so that student easy to manage their Nilam review and book transaction in too. Furthermore, the achievement is made to make sure the student eager to do the Nilam review because it shows the Top 10 in Nilam Achievement. With this features, it helps students and teachers to manage the Nilam review. Besides, this system provides report including the book report, penalty report and more. This feature is made so that can view the statistic report easily. 

# Technology are being used
1) Jquery
2) AJAX, JSON
3) PHP
4) HTML, CSS
5) Bootstrap
6) JAVA
7) Web Socket
8) Web Services
9) ZKTeco SDK
10) Gmail API
11) MySQL

# Hardware are being used 
 - Biometric Device (ZKTeco ZK4500)
 This device is used to scan student’s finger for registration and book transactions. 
- Barcode Device (Aibecy 2D QR 1D USB)
This device is used to scan the barcode that generate for the books. 

# SDK are being used
ZKTeco SDK provide support for ZKteco fingerprint scanners. Its compatible devices for ZK4500 and could be work on windows OS 

# API’s are being used
Gmail API a RESTful API that can be used to access Gmail mailboxes and send mail. For most web applications the Gmail API is the best choice for authorized access to a user's Gmail data.
