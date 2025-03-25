{pkgs}: {
  deps = [
    pkgs.inetutils
    pkgs.dig
    pkgs.unixtools.ping
    pkgs.lsof
  ];
}
