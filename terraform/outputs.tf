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

output "kubeconfig" {
  value = module.eks.kubeconfig
}

output "cluster_endpoint" {
  value = module.eks.cluster_endpoint
}
