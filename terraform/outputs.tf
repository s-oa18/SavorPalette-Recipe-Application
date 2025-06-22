output "rds_endpoint" {
  value = aws_db_instance.mysql.endpoint
}

# AWS Keys
output "github_actions_access_key_id" {
  value       = aws_iam_access_key.github_actions.id
  description = "Access Key ID for GitHub Actions"
  sensitive   = false
}

output "github_actions_secret_access_key" {
  value       = aws_iam_access_key.github_actions.secret
  description = "Secret Access Key for GitHub Actions"
  sensitive   = true
}

# EKS
output "cluster_name" {
  value = module.eks.cluster_name
}

output "cluster_endpoint" {
  value = module.eks.cluster_endpoint
}

output "cluster_ca_certificate" {
  value = module.eks.cluster_certificate_authority_data
}

# Bastion Output
output "bastion_public_ip" {
  value = aws_instance.bastion.public_ip
    description = "Public IP of the Bastion host"
}