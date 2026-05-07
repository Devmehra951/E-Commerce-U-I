# Resolving the GitHub PR conflict

GitHub reports conflicts when the target branch already contains different versions of files under `ecommerce-mobile-theme/`.

This local checkout currently has no configured Git remote or target branch refs, so the actual GitHub target branch cannot be merged inside this container. To resolve the conflict in your local machine or CI runner that has access to the repository remote, run:

```bash
git checkout work
git remote -v
git fetch origin
git merge origin/main
```

If your default branch is not `main`, replace `origin/main` with the branch shown by GitHub as the PR base branch.

When Git marks the theme files as conflicted, keep the current branch's production-ready theme versions unless you intentionally want target-branch changes:

```bash
git checkout --ours ecommerce-mobile-theme/README.md \
  ecommerce-mobile-theme/front-page.php \
  ecommerce-mobile-theme/functions.php \
  ecommerce-mobile-theme/header.php \
  ecommerce-mobile-theme/inc/acf-fields.php \
  ecommerce-mobile-theme/inc/enqueue.php \
  ecommerce-mobile-theme/style.css \
  ecommerce-mobile-theme/template-parts/brands.php \
  ecommerce-mobile-theme/template-parts/hero.php \
  ecommerce-mobile-theme/template-parts/new-arrivals.php

git add ecommerce-mobile-theme/README.md \
  ecommerce-mobile-theme/front-page.php \
  ecommerce-mobile-theme/functions.php \
  ecommerce-mobile-theme/header.php \
  ecommerce-mobile-theme/inc/acf-fields.php \
  ecommerce-mobile-theme/inc/enqueue.php \
  ecommerce-mobile-theme/style.css \
  ecommerce-mobile-theme/template-parts/brands.php \
  ecommerce-mobile-theme/template-parts/hero.php \
  ecommerce-mobile-theme/template-parts/new-arrivals.php

git commit -m "Resolve ecommerce mobile theme merge conflicts"
git push
```

After pushing, refresh the GitHub PR page. The **This branch has conflicts** warning should disappear.

## Notes

- The binary `screenshot.png` was removed from this repository because the PR platform rejected binary files.
- The theme does not require `screenshot.png` to run. If you want the WordPress theme thumbnail, create it locally at `wp-content/themes/ecommerce-mobile-theme/screenshot.png` after installing the theme.
- Do not copy or activate the outer repository folder. Only copy `ecommerce-mobile-theme/` into `wp-content/themes/`.
