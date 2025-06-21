# ECR Repository for SavorPalette App
resource "aws_ecr_repository" "savorpalette" {
  name                 = "savorpalette-app"
  image_tag_mutability = "MUTABLE" # you can change to IMMUTABLE for stricter versioning
  force_delete         = true

  image_scanning_configuration {
    scan_on_push = true
  }

  tags = {
    Name        = "savorpalette-app"
    Environment = "production"
  }
}

# Lifecycle Policies - Cleanup old images
resource "aws_ecr_lifecycle_policy" "savorpalette_policy" {
  repository = aws_ecr_repository.savorpalette.name

  policy = jsonencode({
    rules = [
      {
        rulePriority = 1
        description  = "Expire untagged images older than 30 days"
        selection = {
          tagStatus     = "untagged"
          countType     = "sinceImagePushed"
          countUnit     = "days"
          countNumber   = 30
        }
        action = {
          type = "expire"
        }
      }
    ]
  })
}
