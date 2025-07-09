provider "aws" {
  region = var.aws_region
}

module "vpc" {
  source          = "./modules/vpc"
  vpc_cidr        = var.vpc_cidr
  public_subnets  = var.public_subnets
  private_subnets = var.private_subnets
  azs             = var.azs
  name_prefix     = var.name_prefix
  cluster_name    = var.cluster_name
}


resource "aws_security_group" "rds_sg" {
  name        = "${var.name_prefix}-rds-sg"
  description = "Allow MySQL traffic from EKS nodes"
  vpc_id      = module.vpc.vpc_id

  ingress {
    from_port   = 3306
    to_port     = 3306
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }

  egress {
    from_port   = 0
    to_port     = 0
    protocol    = "-1"
    cidr_blocks = ["0.0.0.0/0"]
  }

  tags = {
    Name = "${var.name_prefix}-rds-sg"
  }
}

module "rds" {
  source        = "./modules/rds"
  name_prefix   = var.name_prefix
  subnet_ids    = module.vpc.private_subnet_ids
  db_sg_id      = aws_security_group.rds_sg.id
  db_name       = var.db_name
  db_username   = var.db_username
  db_password   = var.db_password
}

module "eks" {
  source        = "./modules/eks"
  name_prefix   = var.name_prefix
  vpc_id        = module.vpc.vpc_id
  subnet_ids    = module.vpc.public_subnet_ids
  cluster_name  = var.cluster_name
  
}

module "ecr" {
  source = "./modules/ecr"
  name = "${var.name_prefix}-app"
  
}