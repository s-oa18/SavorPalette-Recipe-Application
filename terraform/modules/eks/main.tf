module "eks" {
  source  = "terraform-aws-modules/eks/aws"
  version = "~> 20.0"

  cluster_name    = var.cluster_name
  cluster_version = "1.29"

  vpc_id     = var.vpc_id
  subnet_ids = var.subnet_ids

  cluster_endpoint_public_access  = true
  cluster_endpoint_private_access = true

  # Automatically grants access to the current Terraform IAM user
  enable_cluster_creator_admin_permissions = true

  access_entries = {
    seth_user = {
      principal_arn     = "arn:aws:iam::728594302455:user/SethAmpofo"
      kubernetes_groups = []

      policy_associations = {
        admin = {
          policy_arn = "arn:aws:eks::aws:cluster-access-policy/AmazonEKSClusterAdminPolicy"
          access_scope = {
            type = "cluster"
          }
        }
      }
    }
  }

  eks_managed_node_group_defaults = {
    instance_types = ["t3.medium"]
    capacity_type  = "ON_DEMAND"
  }

  eks_managed_node_groups = {
    default = {
      desired_size = 2
      max_size     = 3
      min_size     = 1
    }
  }

  enable_irsa = true

  tags = {
    Name = "${var.name_prefix}-eks"
  }
}
