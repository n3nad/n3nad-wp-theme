module.exports = function (api) {
  api.cache(true);

  const presets = [
    ["@babel/preset-env", {
      "targets": [
        "last 2 versions",
        "not dead",
        "not < 2%",
        "not ie 11"
      ],
      "useBuiltIns": "entry"
    }],
    "@babel/preset-react"
  ];
  const plugins = [
    "@babel/plugin-proposal-class-properties",
    "@babel/plugin-syntax-dynamic-import"
  ];

  return {
    presets,
    plugins
  };
}
