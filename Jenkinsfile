pipeline {
    agent {
        dockerfile {
            filename 'environment/local/php-fpm/Dockerfile'
            dir '.'
            args '-v $HOME/.composer:/tmp/.composer'
        }
    }

    environment {
        APP_ENV = 'test'
        MYSQL_HOST = 'localhost'
        MYSQL_DATABASE = 'hushspace'
        MYSQL_USER = 'root'
        MYSQL_PASSWORD = 'root'
        REDIS_HOST = 'localhost'
        REDIS_PORT = '6379'
        COMPOSER_HOME = '/tmp/.composer'
    }

    stages {
        stage('Notify Stash') {
            steps {
                step([$class: 'StashNotifier'])
            }
        }
        stage('Preparation') {
            steps {
                dir('code') {
                    sh 'composer install --no-progress --no-suggest'
                }
            }
        }
        stage('Tests') {
            steps {
                dir('code') {
                    sh 'bin/linter --lint src'
                    sh 'bin/console lint:yaml config --parse-tags'
                    sh 'bin/console lint:twig templates'
                    sh 'vendor/bin/php-cs-fixer fix --dry-run'
                    sh 'vendor/bin/phpmd src --exclude src/Entity,src/Migrations,src/DataFixtures,src/Enum --suffixes php text cleancode,codesize,controversial,design,unusedcode'
                    sh 'bin/console doctrine:schema:validate --skip-sync'
                }
            }
        }
    }
    post {
        always {
            step([$class: 'StashNotifier'])
            step([$class: 'Mailer', notifyEveryUnstableBuild: true, recipients: emailextrecipients([[$class: 'CulpritsRecipientProvider'], [$class: 'RequesterRecipientProvider']])])
            deleteDir()
        }
    }
}