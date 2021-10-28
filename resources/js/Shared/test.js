const route = e => e;

const resolveRoute = name => {
  const re = new RegExp('^https{0,1}://.*$');

  if (re.test(name)) {
    return { external: true, linkRoute: name };
  }

  let linkRoute = '';

  try {
    linkRoute = route(name);
  } catch (error) {
    linkRoute = route('admin.bad.route') + `?route=${name}`;
  }

  return { external: false, linkRoute: linkRoute };
};

console.log(resolveRoute('admin'));

console.log(resolveRoute('https://toggen.com.au'));
