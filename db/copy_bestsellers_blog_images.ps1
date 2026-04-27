$ErrorActionPreference = 'Stop'

$referencesRoot = 'e:\Project\AxCommerce\app\Views\references'
$sourceDir = (Get-ChildItem -Path $referencesRoot -Directory -Filter '*_files' | Select-Object -First 1).FullName
$targetDir = 'e:\Project\AxCommerce\public\attachments\blog_images'

$files = @(
  'tgxcd-dong-hanh-cung-tphcm-khoi-cong-cau-di-bo-sai-gon908.jpg',
  'hop-tac-kinh-doanh-cung-the-gioi-xe-chay-dien285.jpg',
  'chay-thu-xe-dap-dien-xe-may-dien-mien-phi-tai-nha282.jpg',
  'xe-dap-dien-xe-may-dien-tot-nhat-hien-nay552.jpg',
  'bao-ve-vang-xe-dap-dien-xe-may-dien580.jpg',
  'san-xuat-xe-3-banh-tu-che-cho-hang-theo-yeu-cau246.jpg',
  'xe-ban-hang-luu-dong-chay-dien-trao-luu-duoc-ua-chuong-nhat-hien-nay785.jpg'
)

if (-not (Test-Path -Path $targetDir)) {
  New-Item -Path $targetDir -ItemType Directory | Out-Null
}

if ([string]::IsNullOrWhiteSpace($sourceDir) -or -not (Test-Path -Path $sourceDir)) {
  throw "Cannot find source '_files' directory under $referencesRoot"
}

foreach ($name in $files) {
  $src = Join-Path $sourceDir $name
  $dst = Join-Path $targetDir $name

  if (-not (Test-Path -Path $src)) {
    Write-Warning "Missing source file: $src"
    continue
  }

  Copy-Item -Path $src -Destination $dst -Force
  Write-Host "Copied: $name"
}

Write-Host 'Done.'
