output "rds_endpoint" {
  value = module.rds.db_endpoint
}

output "eks_cluster" {
  value = module.eks.cluster_name
}