# Reference existing secret containing DB credentials
data "aws_secretsmanager_secret" "rds_credentials" {
  name = "savorpalette-db-credentials"
}

# Get the latest version of the secret
data "aws_secretsmanager_secret_version" "rds_credentials_version" {
  secret_id = data.aws_secretsmanager_secret.rds_credentials.id
}

# Decode the JSON secret into a local variable
locals {
  credentials = jsondecode(data.aws_secretsmanager_secret_version.rds_credentials_version.secret_string)
}
