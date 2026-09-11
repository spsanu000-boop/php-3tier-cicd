pipeline {
    agent any

    environment {
        AWS_REGION = 'us-east-1'
        ECR_REGISTRY = '970722350756.dkr.ecr.us-east-1.amazonaws.com'
        IMAGE_NAME = 'php-3tier-cicd'
        IMAGE_TAG = "${BUILD_NUMBER}"
    }

    stages {
        stage('Docker Build') {
            steps {
                echo "Building Docker image: ${IMAGE_NAME}:${IMAGE_TAG}"
                sh 'docker build -t ${IMAGE_NAME}:${IMAGE_TAG} .'
            }
        }

        stage('Push to ECR') {
            steps {
                echo "Logging in to Amazon ECR"
                sh '''
                    aws ecr get-login-password --region ${AWS_REGION} | \
                    docker login --username AWS --password-stdin ${ECR_REGISTRY}

                    docker tag ${IMAGE_NAME}:${IMAGE_TAG} \
                    ${ECR_REGISTRY}/${IMAGE_NAME}:${IMAGE_TAG}

                    docker push \
                    ${ECR_REGISTRY}/${IMAGE_NAME}:${IMAGE_TAG}
                '''
            }
        }

        stage('Kubernetes Connection Test') {
            steps {
                withCredentials([file(credentialsId: 'jenkins-kubeconfig', variable: 'KUBECONFIG')]) {
                    sh '''
                        echo "Testing Kubernetes connection..."
                        kubectl --kubeconfig="$KUBECONFIG" get pods -n capstone
                        kubectl --kubeconfig="$KUBECONFIG" auth can-i create deployments -n capstone
                    '''
                }
            }
        }
     stage('Helm Lint') {
            steps {
                echo "Validating Helm chart..."
                sh 'helm lint ./helm/php-3tier-cicd'
            }
        }

