export const resolveRoute = name => {
  const re = new RegExp('^https{0,1}://.*$');

  if (re.test(name)) {
    return { external: true, linkRoute: name };
  }

  let link = '';

  try {
    link = route(name);
  } catch (error) {
    link = route('admin.bad.route') + `?route=${name}`;
  }

  return { external: false, linkRoute: link };
};
