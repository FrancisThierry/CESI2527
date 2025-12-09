from flask import Flask, jsonify
import psycopg2
import os

app = Flask(__name__)

DB_HOST = os.getenv("DB_HOST", "db")
DB_NAME = os.getenv("DB_NAME", "contactsdb")
DB_USER = os.getenv("DB_USER", "user")
DB_PASSWORD = os.getenv("DB_PASSWORD", "password")

def get_contacts():
    conn = psycopg2.connect(
        host=DB_HOST,
        database=DB_NAME,
        user=DB_USER,
        password=DB_PASSWORD
    )
    cur = conn.cursor()
    cur.execute("SELECT id, nom, email FROM contact;")
    rows = cur.fetchall()
    cur.close()
    conn.close()
    return [{"id": r[0], "nom": r[1], "email": r[2]} for r in rows]

@app.route("/contacts", methods=["GET"])
def contacts():
    return jsonify(get_contacts())



if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000)
