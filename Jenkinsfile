pipeline {
    agent any
    tools {
        Maven 'M3'
    }
    stages {
        stage('git repo & clean') {
            steps {
                sh 'rm -rf self_learning'
                sh 'git clone https://github.com/kkalashnikov/self_learning.git'
                sh 'mvn clean -f self_learning'
            }
        }
         stage('install') {
            steps {
                sh 'mvn install -f self_learning'
            }
        }
         stage('test') {
            steps {
                sh 'mvn test -f self_learning'
            }
        }
         stage('package') {
            steps {
                sh 'mvn package -f self_learning'
            }
        }
    }
}
