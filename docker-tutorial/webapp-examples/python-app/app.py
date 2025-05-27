from flask import Flask

app = Flask(__name__)

@app.route('/')
def hello_world():
    return '<h1>Hello from Python and Flask!</h1><p>This app is running inside a Docker container.</p>'

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5000)
