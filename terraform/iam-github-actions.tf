resource "aws_iam_user" "github_actions" {
  name = "github-actions-ecr-user"
}

resource "aws_iam_access_key" "github_actions" {
  user = aws_iam_user.github_actions.name
}

resource "aws_iam_policy" "ecr_push_policy" {
  name        = "GitHubActionsECRPushPolicy"
  description = "Allow GitHub Actions to authenticate and push to ECR"

  policy = jsonencode({
    Version = "2012-10-17",
    Statement = [
      {
        Effect = "Allow",
        Action = [
          "ecr:GetAuthorizationToken"
        ],
        Resource = "*"
      },
      {
        Effect = "Allow",
        Action = [
          "ecr:BatchCheckLayerAvailability",
          "ecr:CompleteMultipartUpload",
          "ecr:GetDownloadUrlForLayer",
          "ecr:BatchGetImage",
          "ecr:PutImage",
          "ecr:InitiateLayerUpload",
          "ecr:UploadLayerPart"
        ],
        Resource = aws_ecr_repository.savorpalette.arn
      }
    ]
  })
}

resource "aws_iam_user_policy_attachment" "attach_policy" {
  user       = aws_iam_user.github_actions.name
  policy_arn = aws_iam_policy.ecr_push_policy.arn
}
