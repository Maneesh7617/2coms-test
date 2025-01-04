# Lead Management System

## Project Description

The **Lead Management System** is a web-based application that allows users to manage leads effectively. Users can import, export, edit, and delete leads. The system supports importing leads from Excel (CSV or XLSX) files and displays the leads in a table format with the ability to edit or delete individual entries. 

### Key Features:
- **Import Leads**: Upload Excel files (CSV or XLSX) to add leads to the system.
- **Export Leads**: Export the lead data to an Excel file for offline use.
- **Manage Leads**: View, edit, and delete individual leads.
- **Responsive Interface**: User-friendly and accessible on all devices.

---

## Project Setup

Follow these steps to set up the project on your local machine.

### Prerequisites
Before setting up the project, make sure you have the following installed:
- PHP (7.4 or higher)
- MySQL
- Composer (for installing dependencies)

### Steps to Set Up Locally:

1. **Clone the repository:**
   Clone this repository to your local machine.

2. **Set up the database:**  
    Create a new MySQL database for the project (e.g., lead_management).
    Import the database schema by running the following SQL query:

CREATE TABLE leads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    status VARCHAR(50) NOT NULL,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

2. **Configure Database Connection:**  
    Open database/db.php and update the database connection details:
    
    <?php
$host = 'localhost'; // Your MySQL host
$dbname = 'lead_management'; // Your database name
$username = 'root'; // Your MySQL username
$password = ''; // Your MySQL password
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

3. **Run the project:** 

4. **Added CSV File also for your refference**