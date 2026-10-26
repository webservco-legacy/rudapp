# RudApp

RudApp, my workspace of 2010 and 2011 for small apps on my RudWEb framework, in one Subversion repository:

- **RudClients**: a licensing system for my clients' installations: licence files signed and checked with OpenSSL,
  updated by the client sites (2010, 2011);
- **RudREPL 1.0**: a browser page that runs posted PHP code, with CodeMirror (2011; later in its own repository,
  [rudrepl](https://github.com/webservco-legacy/rudrepl));
- **RudCast 1.0**: a Windows batch tool that streams any MP3 playlist to an internet radio server, re-encoding it on the
  fly with madplay, LAME and ezstream (2011; its README is in Romanian).

A historical archive, kept read-only: the PHP code of its time is not safe to deploy today, and RudREPL runs any code it
gets (`eval()`): for a local machine only.

## History

| Date | Commit | |
|---|---|---|
| 2010-03-29 | 35bdc79 | the first commits of the RudApp trunk, branch `working-copy-trunk-2010-06` |
| 2010-03-30 | e8de6b1 | the first part of the licensing system |
| 2010-06-10 | 3d52a1f | the files of the working copy that Subversion did not have |
| 2010-09-29 | 0f52cb4 | the trunk started again, branch `main` (the SVN tag `RudWeb-4` of that day is not kept) |
| 2010-09-30 | 1d26006 | the RudWEb app skeleton, branches `RudWEb` and `RudWEb-4` |
| 2011-02-23 | f710fc8 | RudREPL 1.0 |
| 2011-04-30 | 3d834b9 | the licence check app (RudClients) |
| 2011-06-17 | 439d0c7 | RudCast, up to its 1.0 release, the last change |

## What is in it

- `src/RudClients/`, `src/RudREPL/`, `src/RudCast/` on `main`: the three apps; `web/`: the web root;
- `rudapp/`, `public_html/` on the other branches: the app of 2010 (licensing, geo and server modules, templates,
  configs), `work/sort/`: my tests with OpenSSL.

Left out of the whole history: the keys, certificates and licence files (test and client installations), two test
scripts named after a client's members site, and the programs RudCast runs (ezstream, LAME, madplay, Microsoft's common controls
and Visual Basic runtime, a MAD front end) with the release zip that bundles them. RudCast needs ezstream 0.5.6, LAME
and madplay installed next to its batch file. The station and band names in RudCast's samples are replaced by neutral
ones.

## How it was built

From my Subversion repository (`RudApp`, its trunk and branches) and a copy of the 2010 working copy, turned into git in
2026 (15 commits on all branches), the dates and the `git-svn-id` lines kept. The last commit of each branch
before this README sets LF line endings and indents with spaces (not in the third-party code).

## Third-party code

Bundled as it shipped, each under its own licence: CodeMirror (the 2010 version, by Marijn Haverbeke; its own
permissive licence), jQuery 1.4.1 and 1.5 (MIT or GPL), DD_belatedPNG 0.0.8a by Drew Diller (MIT) and Whatever:hover 3.11
by Peter Nederlof (LGPL 2.1).

## Licence

MIT (see `LICENSE`), added in 2026: the project named no licence.

See also: the framework section in [webservco-legacy](https://github.com/webservco-legacy), among them
[rudweb-2009-2011](https://github.com/webservco-legacy/rudweb-2009-2011).
