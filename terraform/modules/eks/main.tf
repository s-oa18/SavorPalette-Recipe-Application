module "eks" {
  source          = "terraform-aws-modules/eks/aws"
  cluster_name    = var.cluster_name
  cluster_version = "1.29"
  subnet_ids         = var.subnet_ids
  vpc_id          = var.vpc_id

  eks_managed_node_groups = {
    default = {
      instance_types = ["t3.medium"]
      capacity_type  = "ON_DEMAND"

      scaling_config = {
        desiredSize = 2
        maxSize     = 3
        minSize     = 1
}
    }
  }

  enable_irsa = true

  tags = {
    Name = "${var.name_prefix}-eks"
  }
}