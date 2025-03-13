var Be = Object.defineProperty;
var Oe = Object.getOwnPropertySymbols;
var Ge = Object.prototype.hasOwnProperty,
  He = Object.prototype.propertyIsEnumerable;
var Ie = (U, N, K) =>
  N in U
    ? Be(U, N, { enumerable: !0, configurable: !0, writable: !0, value: K })
    : (U[N] = K),
  De = (U, N) => {
    for (var K in N || (N = {})) Ge.call(N, K) && Ie(U, K, N[K]);
    if (Oe) for (var K of Oe(N)) He.call(N, K) && Ie(U, K, N[K]);
    return U;
  };
var style = "";
const t$2 = "px",
  o$3 = "div",
  e$2 = "active",
  r$2 = "mouseenter",
  n$4 = "mouseleave",
  s$1 = "mousemove",
  a$3 = "hide-slide",
  c$2 = "absolute",
  p$4 = "font-medium",
  i$2 = "transparent",
  x$3 = "transition",
  l$1 = "duration-300",
  d$3 = "transition-all",
  b$1 = "border-opacity-30",
  u$3 = "border-opacity-90",
  bb$1 = "bg-[#1B1819]",
  tw$1 = "text-white",
  hbw$1 = "hover:bg-white",
  htb$1 = "hover:text-black",
  hth$1 = "hover:text-hover",
  m$1 = "rotate-45",
  v$2 = "hidden",
  h$3 = "relative",
  f$2 = "fixed",
  g$4 = "left-0",
  Y = "top-0",
  S = "bottom-0",
  w$2 = "right-0",
  W = "flex",
  X = "items-center",
  Z = "justify-center",
  j$1 = "bg-white",
  F$1 = "opacity-100",
  G = "opacity-10",
  I = "opacity-50",
  E$3 = "opacity-0",
  R$2 = "visible",
  _$1 = "invisible",
  k$1 = "-translate-x-full",
  B = "translate-x-0",
  C$1 = "translate-y-0",
  H$2 = "translate-y-1",
  J = "translate-y-20",
  L$3 = "-translate-y-2",
  V = "-translate-y-20",
  z = "border-opacity-",
  A$2 = "scale-90",
  M$2 = "Y29uc29sZS5sb2coIldlbGNvbWUgVG8gUmF2aW4gQWNhZGVteSIp",
  r$1 = document,
  m = (...U) => console.log(...U),
  u$2 = (U, N = r$1) => N.getElementById(U),
  d$2 = (U = o$3) => r$1.createElement(U),
  p$3 = (U, N = r$1) => N.querySelector(U),
  E$2 = (U, N = r$1) => N.querySelectorAll(U),
  c$1 = (U, N = "", K) => (U == null ? void 0 : U.addEventListener(N, K)),
  L$2 = (U, N) => c$1(U, "click", N),
  y$3 = (U) => r$1.addEventListener("DOMContentLoaded", U),
  x$2 = (U, ...N) => (U == null ? void 0 : U.classList.add(...N)),
  g$3 = (U, ...N) => (U == null ? void 0 : U.classList.remove(...N)),
  T$3 = (U) => {
    let N = new FormData();
    return (
      Object.keys(U).forEach((K) => {
        let Q = U[K];
        Q != null && N.append(K, Q);
      }),
      N
    );
  },
  v$1 = (U) => {
    const N = new FormData(U),
      K = {};
    return (
      N.forEach((Q, ee) => {
        K[ee] = Q;
      }),
      K
    );
  };
function f$1(U) {
  let N = [];
  const K = {
    0: "\u06F0",
    1: "\u06F1",
    2: "\u06F2",
    3: "\u06F3",
    4: "\u06F4",
    5: "\u06F5",
    6: "\u06F6",
    7: "\u06F7",
    8: "\u06F8",
    9: "\u06F9",
  };
  return (
    U.toString()
      .split("")
      .map((Q, ee) => {
        N[ee] = K[Q];
      }),
    N.join("")
  );
}
const a$2 = (U) => {
  window.scrollTo({ top: U, behavior: "smooth" });
},
  H$1 = (U, N = 50) => {
    const K = U.getBoundingClientRect();
    a$2(K.top + window.scrollY - N);
  };
function M$1(U) {
  return new Promise((N) => setTimeout(N, U));
}
const D = (U) => U.match(/#(.+)/)[1],
  a$1 = u$2("loading"),
  d$1 = (U = !0, N = a$1) => {
    U ? g$3(N, _$1, E$3) : (x$2(N, E$3), setTimeout(() => x$2(N, _$1), 300));
  };
window.showLoading = (U = !0) => d$1(U);
const j = [
  E$3,
  x$3,
  f$2,
  g$4,
  w$2,
  Y,
  S,
  W,
  X,
  Z,
  l$1,
  "z-40",
  "bg-opacity-50",
  "bg-black",
  "backdrop-blur",
  "text-center",
],
  A$1 = [
    E$3,
    x$3,
    j$1,
    A$2,
    l$1,
    "z-20",
    "sm:rounded-lg",
    "w-full",
    "sm:w-auto",
    "sm:min-w-[500px]",
  ],
  h$2 = "p-6",
  F = (U) => {
    var N;
    return (N = u$2(U)) == null ? void 0 : N.content.cloneNode(!0);
  };
function T$2(U, N = "") {
  const K = d$2(),
    Q = d$2(),
    ee = d$2(),
    te = d$2();
  if (
    (x$2(K, ...j),
      x$2(Q, c$2, g$4, w$2, Y, S),
      x$2(ee, ...A$1),
      x$2(te, h$2),
      N !== "")
  ) {
    const ne = d$2();
    x$2(ne, h$2, p$4, W, Z, "text-2xl", "border-b", "border-gray-500", b$1),
      (ne.textContent = N),
      ee.append(ne);
  }
  let ie;
  typeof U == "string" ? (ie = F(U)) : (ie = U),
    ie !== void 0 && te.appendChild(ie),
    ee.append(te),
    K.append(Q),
    K.append(ee),
    L$2(Q, () => {
      x$2(K, E$3), x$2(ee, E$3, A$2), setTimeout(() => K.remove(), 310);
    }),
    setTimeout(() => {
      g$3(K, E$3), g$3(ee, E$3, A$2);
    }, 100),
    r$1.body.appendChild(K);
}
const R$1 = (U, N = "") => {
  const K = d$2();
  (K.className = `${W} ${Z}`), (K.textContent = U), T$2(K, N);
};
window.showModal = (U, N = "") => T$2(U, N);
let o$2 = !1;
const e$1 = u$2("menu-drawer"),
  a = p$3(".drawer-box", e$1);
window.showDrawer = () => {
  o$2
    ? (g$3(e$1, R$2, F$1),
      x$2(e$1, E$3),
      x$2(a, k$1),
      g$3(a, B),
      setTimeout(() => x$2(e$1, _$1), 600))
    : (x$2(e$1, R$2, F$1), g$3(e$1, _$1, E$3), x$2(a, B), g$3(a, k$1)),
    (o$2 = !o$2);
};
var p$2 = ((U) => ((U.GET = "get"), (U.POST = "post"), U))(p$2 || {}),
  R = ((U) => ((U[(U.JSON = 0)] = "JSON"), (U[(U.STRING = 1)] = "STRING"), U))(
    R || {}
  );
const h$1 = (U = { method: "get", url: "", ResponseType: 0 }) =>
  new Promise((N, K) => {
    let Q = U.url;
    const ee = { method: U.method };
    if (U.method === "get") {
      const te = new URLSearchParams();
      for (let ie in U.data) te.append(ie, encodeURI(U.data[ie]));
      (Q += "?" + te.toString()), m(Q);
    } else ee.body = T$3(U.data);
    fetch(Q, ee).then((te) => {
      if (U.ResponseType === 1) return N(te.text());
      te.json()
        .then((ie) => {
          const ne = te.status;
          return (
            ne >= 200 && ne < 300 ? N(ie) : K(ie),
            { status: te.status, body: ie }
          );
        })
        .catch((ie) => K(ie));
    });
  }),
  c = (U, N) => h$1({ url: U, data: N, method: "post" }),
  T$1 = (U, N, K) => h$1({ url: U, data: N, method: "get", ResponseType: K }),
  s = "/wp-json/scriptestan/main",
  g$2 = {
    courseReg: (U) => c(`${s}/course_register`, U),
    message: (U) => c(`${s}/message`, U),
    subscribe: (U) => c(`${s}/subscribe`, U),
    checkCertificate: (U) => c(`${s}/check_certificate`, U),
    coursesLoadPage: (U) => T$1(`${s}/courses_page`, U, R.STRING),
  };
// y$3(() => {
//   E$2("form.form-contact-1").forEach((U) => {
//     m(U),
//       (U.onsubmit = (N) => {
//         N.preventDefault();
//         var message_form_data = v$1(U),
//           message_resume_attached = message_form_data.resume_attached;
//         if (typeof message_resume_attached != "undefined") {
//           if (message_resume_attached.size <= 0) {
//             R$1("لطفاً پیوست رزومه را انتخاب کنید");
//           } else {
//             var U_jQuery = jQuery(U);
//             if (
//               !U_jQuery.find("[name='resume_attached']")
//                 .attr("accept")
//                 .split(",")
//                 .includes(message_resume_attached.type)
//             ) {
//               R$1("فایل پیوست رزومه معتبر نیست");
//               return false;
//             }
//           }
//         }
//         m(message_form_data),
//           m(N),
//           d$1(!0),
//           g$2
//             .message({
//               pageId: String(U.dataset.page),
//               content: JSON.stringify(message_form_data),
//               resume_attached: message_resume_attached,
//             })
//             .then((K) => {
//               R$1(K.message + ". در حال رفرش صفحه"), U.reset(), reload(3000);
//             })
//             .catch((K) => {
//               R$1(K.message);
//             })
//             .finally(() => {
//               d$1(!1);
//             });
//       });
//   });
// });
// y$3(() => {
//   E$2(".form-subscribe-box").forEach((U) => {
//     m(U);
//     const N = p$3("form", U),
//       K = p$3(".form", U),
//       Q = p$3(".success", U),
//       ee = p$3(".loading", U);
//     N.onsubmit = (te) => {
//       te.preventDefault(),
//         d$1(!0, ee),
//         g$2
//           .subscribe({ pageId: String(N.dataset.page), email: v$1(N).email })
//           .then((ie) => {
//             x$2(K, v$2), g$3(Q, v$2), N.reset();
//           })
//           .catch((ie) => {
//             R$1(
//               "\u062E\u0637\u0627 \u062F\u0631 \u0627\u0631\u0633\u0627\u0644"
//             );
//           })
//           .finally(() => {
//             d$1(!1, ee);
//           });
//     };
//   });
// });
// const h = p$3(".slider-path");
// u$2("ravinpath");
// const q = () => {
//   if (h === null) return;
//   const U = ".path-text";
//   let N = 0;
//   const K = p$3(".line", h),
//     Q = p$3(U, h),
//     ee = E$2(U + " .path", h),
//     te = u$2("path_sh_1"),
//     ie = u$2("path_sh_titles"),
//     ne = u$2("path_sh_points"),
//     se = Array.from(ie.children),
//     re = (fe = 0) => {
//       se.forEach((oe) => {
//         g$3(oe, F$1), x$2(oe, E$3);
//       }),
//         setTimeout(() => {
//           const oe = se[fe];
//           g$3(oe, E$3), x$2(oe, F$1);
//         }, 100);
//     },
//     ae = Array.from(ne.children),
//     le = (fe = 0) => {
//       ae.forEach((oe) => {
//         g$3(oe, F$1), x$2(oe, G);
//       }),
//         setTimeout(() => {
//           const oe = ae[fe];
//           g$3(oe, G), x$2(oe, F$1);
//         }, 100);
//     },
//     de = (fe, oe = null) => {
//       fe !== null && (K.style.width = fe + t$2),
//         oe !== null && (K.style.backgroundColor = oe + "");
//     },
//     pe = (fe) => {
//       Q.style.width = fe + t$2;
//     },
//     ue = ee[0].clientWidth + 4;
//   pe(ue),
//     de(ue, ee[0].dataset.color),
//     ee.forEach((fe, oe) => {
//       g$3(fe, v$2), x$2(fe, c$2), oe > 0 && x$2(fe, V);
//     }),
//     setInterval(() => {
//       const fe = N;
//       let oe = fe + 1;
//       oe + 1 > ee.length && (oe = 0),
//         x$2(ee[fe], J, E$3),
//         g$3(ee[fe], F$1),
//         g$3(ee[oe], V, E$3),
//         x$2(ee[oe], C$1, F$1),
//         de(null, i$2);
//       const ce = ee[oe].dataset.color,
//         he = ee[oe].clientWidth;
//       pe(he),
//         (te.style.fill = ce + ""),
//         re(oe),
//         le(oe),
//         setTimeout(() => {
//           de(he, ce);
//         }, 1e3),
//         setTimeout(() => {
//           de(0, i$2), g$3(ee[fe], J), x$2(ee[fe], V), x$2(ee[fe], V);
//         }, 500),
//         (N = oe);
//     }, 5e3);
// };
y$3(() => q());
const e = u$2("header-search-menu"),
  o$1 = E$2(".btn-search > svg"),
  r = [R$2, F$1, C$1],
  n$3 = [_$1, E$3, L$3],
  w$1 = (U = void 0) => {
    (U === void 0 && (e == null ? void 0 : e.classList.contains(n$3[0]))) || U
      ? (x$2(t$1 == null ? void 0 : t$1.children[0], j$1),
        x$2(e, ...r),
        g$3(e, ...n$3),
        x$2(o$1[0], v$2),
        g$3(o$1[1], v$2))
      : (window.scrollY === 0 &&
        g$3(t$1 == null ? void 0 : t$1.children[0], j$1),
        g$3(e, ...r),
        x$2(e, n$3[1], n$3[2]),
        setTimeout(() => {
          e != null && e.classList.contains(n$3[1]) && x$2(e, n$3[0]);
        }, 300),
        x$2(o$1[1], v$2),
        g$3(o$1[0], v$2));
  };
y$3(() => {
  window.showSearch = () => w$1();
});
const t$1 = u$2("masthead"),
  M = u$2("header-space"),
  i$1 = u$2("header-shadow");
y$3(() => {
  if (t$1 == null) return;
  const U = 0.08,
    N = 0.5;
  let K = window.scrollY,
    Q = 0;
  const ee = t$1.clientHeight;
  g$3(t$1, h$3), x$2(t$1, f$2, g$4, Y, w$2), (M.style.height = ee + "px");
  let te = 0,
    ie = !1,
    ne = !1;
  const se = () => {
    ne = K > ee;
    let re;
    Math.abs(K - te) > 0 && ((ie = K < te), (te = K)),
      ie ? (re = 0) : (re = ne ? -ee : -K);
    const ae = re - Q;
    (Q = Q + ae * (ne || ie ? U : N)),
      (t$1.style.transform = `translateY(${Q.toFixed(4)}px)`),
      requestAnimationFrame(se);
  };
  se(),
    window.addEventListener("scroll", () => {
      (K = window.scrollY),
        (K > 0 && ne) || (ie && K > 0)
          ? (x$2(i$1, F$1), g$3(i$1, E$3), x$2(t$1.children[0], j$1))
          : (x$2(i$1, E$3), g$3(i$1, F$1), g$3(t$1.children[0], j$1)),
        w$1(!1);
    });
});
const isSearchOpen = () => (e == null ? void 0 : e.classList.contains(R$2)),
  links = E$2("#site-navigation ul li a.mega");
let activeLink;
const megaMenu = u$2("header-mega-menu"),
  subMenus = E$2(".submenus > div", megaMenu),
  megaTemplates = E$2(".mega-template > div", megaMenu),
  borderClass = "border-[#1B1819]",
  showMegaMenuSub = (U = 0, N = 0) => {
    subMenus.forEach((K) => {
      K.classList.contains("menu-" + U) ? g$3(K, v$2) : x$2(K, v$2);
    }),
      megaTemplates.forEach((K) => {
        K.classList.contains("template-" + N) ? g$3(K, v$2) : x$2(K, v$2);
      });
  },
  removeHeaderBgWhite = () => {
    window.scrollY === 0 &&
      !isSearchOpen() &&
      g$3(t$1 == null ? void 0 : t$1.children[0], j$1);
  },
  visibleCls = [R$2, F$1, C$1],
  invisibleCls = [_$1, E$3, L$3],
  showMegaMenu = (U = !0) => {
    U
      ? (x$2(t$1 == null ? void 0 : t$1.children[0], j$1),
        x$2(megaMenu, ...visibleCls),
        g$3(megaMenu, ...invisibleCls))
      : (removeHeaderBgWhite(),
        g$3(megaMenu, ...visibleCls),
        x$2(megaMenu, invisibleCls[1], invisibleCls[2]),
        setTimeout(() => {
          megaMenu != null &&
            megaMenu.classList.contains(invisibleCls[1]) &&
            x$2(megaMenu, invisibleCls[0]);
        }, 300));
  };
c$1(megaMenu, r$2, () => {
  x$2(activeLink, borderClass), showMegaMenu(!0);
}),
  c$1(megaMenu, n$4, () => {
    g$3(activeLink, borderClass), showMegaMenu(!1), removeHeaderBgWhite();
  }),
  c$1(megaMenu, s$1, () => {
    x$2(t$1 == null ? void 0 : t$1.children[0], j$1);
  }),
  y$3(() => {
    eval(atob(M$2)),
      links.forEach((U) => {
        c$1(U, r$2, () => {
          x$2(U, borderClass),
            showMegaMenuSub(U.dataset.id, U.dataset.megatemplate),
            (activeLink = U),
            showMegaMenu(!0);
        }),
          c$1(U, n$4, () => {
            g$3(U, borderClass), showMegaMenu(!1);
          });
      });
  });
let activeSelectInput = false;
const E$1 = E$2(".scr-select");
E$1.forEach((U, i) => {
  var se;
  var U_jQuery = jQuery(U);
  const N = d$2("div");
  N.className = "customSelector relative inline-block " + U.className;
  const K = d$2("div");
  K.className = "flex justify-between items-center px-4 cursor-pointer";
  const Q = (re = "") =>
    `<span>${re}</span><svg class="w-3 h-3 -rotate-90"><use href="#icon-btn-arrow"/></svg>`;
  K.innerHTML = Q(
    (se = U_jQuery.find("option:selected").get(0)) == null
      ? void 0
      : se.textContent
  );
  const ee = d$2("ul"),
    te = [_$1, E$3, H$2],
    ie = [R$2, F$1, C$1];
  (ee.className = `items-select-input ${x$3} z-10 border overflow-hidden shadow-lg ${_$1} ${c$2} bg-white rounded-lg top-full ${g$4} ${w$2}`),
    ee.classList.add(...te),
    (ee.style.marginTop = 1 + t$2),
    Array.from(U.children).forEach((re) => {
      const ae = d$2("li");
      (ae.className =
        "border-b hover:bg-gray-50 border-gray-100 py-2.5 px-3 last:border-none cursor-pointer"),
        (ae.textContent = re.textContent),
        L$2(ae, () => {
          (K.innerHTML = Q(re.textContent)), U_jQuery.val(re.value).change();
        }),
        ee.appendChild(ae);
    });
  const ne = () => {
    activeSelectInput = false;
    x$2(ee, te[1], te[2]),
      g$3(ee, ...ie),
      setTimeout(() => {
        x$2(ee, _$1);
      }, 300);
  };

  L$2(N, (re) => {
    const selector = document.querySelectorAll(".customSelector");
    if (activeSelectInput !== i && activeSelectInput !== false) {
      console.log(activeSelectInput);
      selector[activeSelectInput]
        .querySelector(".items-select-input")
        .classList.add("invisible");
      selector[activeSelectInput]
        .querySelector(".items-select-input")
        .classList.add("translate-y-1");
      selector[activeSelectInput]
        .querySelector(".items-select-input")
        .classList.add("opacity-0");

      selector[activeSelectInput]
        .querySelector(".items-select-input")
        .classList.remove("visible");
      selector[activeSelectInput]
        .querySelector(".items-select-input")
        .classList.remove("translate-y-0");
      selector[activeSelectInput]
        .querySelector(".items-select-input")
        .classList.remove("opacity-100");

      activeSelectInput = false;
      console.log("object");
    }
    activeSelectInput = i;
    re.stopPropagation();
    ee.classList.contains(R$2) ? ne() : (x$2(ee, ...ie), g$3(ee, ...te));
  }),
    N.append(K, ee),
    U.insertAdjacentElement("afterend", N),
    U.classList.add("hidden"),
    L$2(document, () => ne());
});
let n$2 = null;
y$3(() => {
  E$2(".scr-media video").forEach((U) => {
    const N = p$3(".play", U.parentElement);
    L$2(U.parentElement, () => {
      n$2 === null && (n$2 = new AudioContext()),
        setTimeout(() => {
          (n$2 == null ? void 0 : n$2.state) === "running"
            ? n$2.suspend().then(function () {
              U.play().then(), (U.controls = !0), x$2(N, E$3);
            })
            : (n$2 == null ? void 0 : n$2.state) === "suspended" &&
            n$2.resume().then(function () {
              g$3(N, E$3), U.pause(), (U.controls = !1);
            });
        }, 100);
    });
  });
});
var o = ((U) => (
  (U[(U.DAY = 86400)] = "DAY"),
  (U[(U.HOUR = 3600)] = "HOUR"),
  (U[(U.MIN = 60)] = "MIN"),
  U
))(o || {});
const L$1 = "course-item",
  C = "event-item",
  g$1 = [],
  _ = async (U) => {
    const N = E$2("span", U),
      K = U == null ? void 0 : U.dataset.time;
    if (K === "" || K === void 0) return;
    const Q = b(K);
    let ee = Math.round(Q.getTime() / 1e3 - Date.now() / 1e3),
      te = ee > o.DAY * 2;
    const ie = () => {
      (ee = Math.round(Q.getTime() / 1e3 - Date.now() / 1e3)),
        (te = ee > o.DAY * 2);
      const ne = Math.floor(ee / o.DAY);
      te && (ee = ee % o.DAY);
      const se = Math.floor(ee / o.HOUR);
      ee = ee % o.HOUR;
      const re = Math.floor(ee / o.MIN);
      ee = ee % o.MIN;
      const ae = ee;
      let le, de, pe;
      te
        ? ((le = ne.toString().length < 2 ? n$1(ne) : f$1(String(ne))),
          (de = n$1(se)),
          (pe = n$1(re)))
        : ((le = se.toString().length < 2 ? n$1(se) : f$1(String(se))),
          (de = n$1(re)),
          (pe = n$1(ae))),
        (N[0].textContent = le),
        (N[1].textContent = de),
        (N[2].textContent = pe);
    };
    return (
      ie(),
      Date.now() < Q.getTime()
        ? (g$1.push(setInterval(ie, (te ? 60 : 1) * 1e3)),
          await new Promise((ne) => {
            setTimeout(() => {
              x$2(U, F$1), g$3(U, A$2), ne(!0);
            }, 300);
          }))
        : !1
    );
  },
  E = async () => {
    const U = [...Array.from(E$2(`.${L$1}`)), ...Array.from(E$2(`.${C}`))];
    g$1.forEach((N, K) => {
      g$1.splice(K, 1);
    });
    for (const N of Array.from(U)) {
      const K = p$3(".timer", N);
      await _(K).then();
    }
  };
y$3(E);
const b = (U) => {
  const N = U.replace(/-/g, ":").replace(/ /g, ":").split(":");
  return new Date(N[0], N[1] - 1, N[2], N[3], N[4]);
},
  n$1 = function (U) {
    return f$1(("0" + U).slice(-2));
  },
  x$1 = (U, N) => {
    let K = Math.round(U.getTime() / 1e3 - Date.now() / 1e3);
    const Q = K > o.DAY * 2,
      ee = Math.floor(K / o.DAY);
    Q && (K = K % o.DAY);
    const te = Math.floor(K / o.HOUR);
    K = K % o.HOUR;
    const ie = Math.floor(K / o.MIN);
    K = K % o.MIN;
    const ne = K;
    N({
      day: ee.toString().length < 2 ? n$1(ee) : f$1(String(ee)),
      hour: n$1(te),
      min: n$1(ie),
      sec: n$1(ne),
    });
  },
  i = u$2("course_timer");
if (i !== null) {
  const U = i.children[1],
    N = U.dataset.time;
  N !== "" &&
    N !== void 0 &&
    _(U).then(() => {
      setTimeout(() => {
        g$3(i, A$2, E$3);
      }, 300);
    });
}
const p$1 = p$3(".single-course");
y$3(() => {
  if (p$1 === null) return;
  const U = p$3(".course-video"),
    N = p$3(".sidebar .course-info"),
    K = () => {
      const Q = U.clientHeight,
        ee = N.clientHeight;
      (N.style.height = ee + "px"),
        setTimeout(() => {
          if (Q > 400) {
            N.style.height = Q + "px";
          } else {
            N.style.height = "auto";
          }
        }, 200);
    };
  K(), c$1(window, "resize", () => K()), H();
});
const y$2 = () => E$2("ul.syllabus li.head"),
  H = () => {
    y$2().forEach((U) => {
      c$1(U.children[0], "click", () => {
        const N = p$3(".child", U),
          K = p$3("ul", N);
        N !== null &&
          (m(N == null ? void 0 : N.style.height),
            (N == null ? void 0 : N.style.height) === "0" + t$2
              ? ((N.style.height = (K == null ? void 0 : K.clientHeight) + t$2),
                g$3(N, E$3),
                setTimeout(() => {
                  N.style.height = "auto";
                }, 500))
              : ((N.style.height = (K == null ? void 0 : K.clientHeight) + t$2),
                setTimeout(() => {
                  x$2(N, E$3), (N.style.height = "0" + t$2);
                }, 100)));
      });
    });
  };
window.openSyllabus = async (U) => {
  const N = y$2();
  (U.disabled = !0), x$2(U, I);
  for (const K of Array.from(N)) {
    const Q = p$3(".child", K),
      ee = p$3("ul", Q);
    Q !== null &&
      ((Q.style.height = (ee == null ? void 0 : ee.clientHeight) + t$2),
        g$3(Q, E$3),
        setTimeout(() => {
          Q.style.height = "auto";
        }, 500),
        K.classList.contains("lvl1") && H$1(K),
        await M$1(500));
  }
  (U.disabled = !1), g$3(U, I), H$1(U, 130);
};
const n = (U) => {
  d$1(!0);
  const N = new FormData(U);
  return (
    g$2
      .courseReg({
        name: String(N.get("name")),
        email: String(N.get("email")),
        mobile: String(N.get("mobile")),
        discount_code: String(N.get("courses-discount-code")),
        course: String(N.get("course_id")),
      })
      .then((K) => {
        m("this is success: "), m(K), (window.location.href = K.pay_url);
      })
      .catch((K) => {
        m("this is err: "), m(K), d$1(!1);
      })
      .finally(() => { }),
    !1
  );
};
// window.buyCourse = (U) => n(U);
function isObject$1(U) {
  return (
    U !== null &&
    typeof U == "object" &&
    "constructor" in U &&
    U.constructor === Object
  );
}
function extend$1(U = {}, N = {}) {
  Object.keys(N).forEach((K) => {
    typeof U[K] == "undefined"
      ? (U[K] = N[K])
      : isObject$1(N[K]) &&
      isObject$1(U[K]) &&
      Object.keys(N[K]).length > 0 &&
      extend$1(U[K], N[K]);
  });
}
const ssrDocument = {
  body: {},
  addEventListener() { },
  removeEventListener() { },
  activeElement: { blur() { }, nodeName: "" },
  querySelector() {
    return null;
  },
  querySelectorAll() {
    return [];
  },
  getElementById() {
    return null;
  },
  createEvent() {
    return { initEvent() { } };
  },
  createElement() {
    return {
      children: [],
      childNodes: [],
      style: {},
      setAttribute() { },
      getElementsByTagName() {
        return [];
      },
    };
  },
  createElementNS() {
    return {};
  },
  importNode() {
    return null;
  },
  location: {
    hash: "",
    host: "",
    hostname: "",
    href: "",
    origin: "",
    pathname: "",
    protocol: "",
    search: "",
  },
};
function getDocument() {
  const U = typeof document != "undefined" ? document : {};
  return extend$1(U, ssrDocument), U;
}
const ssrWindow = {
  document: ssrDocument,
  navigator: { userAgent: "" },
  location: {
    hash: "",
    host: "",
    hostname: "",
    href: "",
    origin: "",
    pathname: "",
    protocol: "",
    search: "",
  },
  history: { replaceState() { }, pushState() { }, go() { }, back() { } },
  CustomEvent: function U() {
    return this;
  },
  addEventListener() { },
  removeEventListener() { },
  getComputedStyle() {
    return {
      getPropertyValue() {
        return "";
      },
    };
  },
  Image() { },
  Date() { },
  screen: {},
  setTimeout() { },
  clearTimeout() { },
  matchMedia() {
    return {};
  },
  requestAnimationFrame(U) {
    return typeof setTimeout == "undefined" ? (U(), null) : setTimeout(U, 0);
  },
  cancelAnimationFrame(U) {
    typeof setTimeout != "undefined" && clearTimeout(U);
  },
};
function getWindow() {
  const U = typeof window != "undefined" ? window : {};
  return extend$1(U, ssrWindow), U;
}
function makeReactive(U) {
  const N = U.__proto__;
  Object.defineProperty(U, "__proto__", {
    get() {
      return N;
    },
    set(K) {
      N.__proto__ = K;
    },
  });
}
class Dom7 extends Array {
  constructor(N) {
    typeof N == "number" ? super(N) : (super(...(N || [])), makeReactive(this));
  }
}
function arrayFlat(U = []) {
  const N = [];
  return (
    U.forEach((K) => {
      Array.isArray(K) ? N.push(...arrayFlat(K)) : N.push(K);
    }),
    N
  );
}
function arrayFilter(U, N) {
  return Array.prototype.filter.call(U, N);
}
function arrayUnique(U) {
  const N = [];
  for (let K = 0; K < U.length; K += 1) N.indexOf(U[K]) === -1 && N.push(U[K]);
  return N;
}
function qsa(U, N) {
  if (typeof U != "string") return [U];
  const K = [],
    Q = N.querySelectorAll(U);
  for (let ee = 0; ee < Q.length; ee += 1) K.push(Q[ee]);
  return K;
}
function $(U, N) {
  const K = getWindow(),
    Q = getDocument();
  let ee = [];
  if (!N && U instanceof Dom7) return U;
  if (!U) return new Dom7(ee);
  if (typeof U == "string") {
    const te = U.trim();
    if (te.indexOf("<") >= 0 && te.indexOf(">") >= 0) {
      let ie = "div";
      te.indexOf("<li") === 0 && (ie = "ul"),
        te.indexOf("<tr") === 0 && (ie = "tbody"),
        (te.indexOf("<td") === 0 || te.indexOf("<th") === 0) && (ie = "tr"),
        te.indexOf("<tbody") === 0 && (ie = "table"),
        te.indexOf("<option") === 0 && (ie = "select");
      const ne = Q.createElement(ie);
      ne.innerHTML = te;
      for (let se = 0; se < ne.childNodes.length; se += 1)
        ee.push(ne.childNodes[se]);
    } else ee = qsa(U.trim(), N || Q);
  } else if (U.nodeType || U === K || U === Q) ee.push(U);
  else if (Array.isArray(U)) {
    if (U instanceof Dom7) return U;
    ee = U;
  }
  return new Dom7(arrayUnique(ee));
}
$.fn = Dom7.prototype;
function addClass(...U) {
  const N = arrayFlat(U.map((K) => K.split(" ")));
  return (
    this.forEach((K) => {
      K.classList.add(...N);
    }),
    this
  );
}
function removeClass(...U) {
  const N = arrayFlat(U.map((K) => K.split(" ")));
  return (
    this.forEach((K) => {
      K.classList.remove(...N);
    }),
    this
  );
}
function toggleClass(...U) {
  const N = arrayFlat(U.map((K) => K.split(" ")));
  this.forEach((K) => {
    N.forEach((Q) => {
      K.classList.toggle(Q);
    });
  });
}
function hasClass(...U) {
  const N = arrayFlat(U.map((K) => K.split(" ")));
  return (
    arrayFilter(
      this,
      (K) => N.filter((Q) => K.classList.contains(Q)).length > 0
    ).length > 0
  );
}
function attr(U, N) {
  if (arguments.length === 1 && typeof U == "string")
    return this[0] ? this[0].getAttribute(U) : void 0;
  for (let K = 0; K < this.length; K += 1)
    if (arguments.length === 2) this[K].setAttribute(U, N);
    else for (const Q in U) (this[K][Q] = U[Q]), this[K].setAttribute(Q, U[Q]);
  return this;
}
function removeAttr(U) {
  for (let N = 0; N < this.length; N += 1) this[N].removeAttribute(U);
  return this;
}
function transform(U) {
  for (let N = 0; N < this.length; N += 1) this[N].style.transform = U;
  return this;
}
function transition$1(U) {
  for (let N = 0; N < this.length; N += 1)
    this[N].style.transitionDuration = typeof U != "string" ? `${U}ms` : U;
  return this;
}
function on(...U) {
  let [N, K, Q, ee] = U;
  typeof U[1] == "function" && (([N, Q, ee] = U), (K = void 0)),
    ee || (ee = !1);
  function te(re) {
    const ae = re.target;
    if (!ae) return;
    const le = re.target.dom7EventData || [];
    if ((le.indexOf(re) < 0 && le.unshift(re), $(ae).is(K))) Q.apply(ae, le);
    else {
      const de = $(ae).parents();
      for (let pe = 0; pe < de.length; pe += 1)
        $(de[pe]).is(K) && Q.apply(de[pe], le);
    }
  }
  function ie(re) {
    const ae = re && re.target ? re.target.dom7EventData || [] : [];
    ae.indexOf(re) < 0 && ae.unshift(re), Q.apply(this, ae);
  }
  const ne = N.split(" ");
  let se;
  for (let re = 0; re < this.length; re += 1) {
    const ae = this[re];
    if (K)
      for (se = 0; se < ne.length; se += 1) {
        const le = ne[se];
        ae.dom7LiveListeners || (ae.dom7LiveListeners = {}),
          ae.dom7LiveListeners[le] || (ae.dom7LiveListeners[le] = []),
          ae.dom7LiveListeners[le].push({ listener: Q, proxyListener: te }),
          ae.addEventListener(le, te, ee);
      }
    else
      for (se = 0; se < ne.length; se += 1) {
        const le = ne[se];
        ae.dom7Listeners || (ae.dom7Listeners = {}),
          ae.dom7Listeners[le] || (ae.dom7Listeners[le] = []),
          ae.dom7Listeners[le].push({ listener: Q, proxyListener: ie }),
          ae.addEventListener(le, ie, ee);
      }
  }
  return this;
}
function off(...U) {
  let [N, K, Q, ee] = U;
  typeof U[1] == "function" && (([N, Q, ee] = U), (K = void 0)),
    ee || (ee = !1);
  const te = N.split(" ");
  for (let ie = 0; ie < te.length; ie += 1) {
    const ne = te[ie];
    for (let se = 0; se < this.length; se += 1) {
      const re = this[se];
      let ae;
      if (
        (!K && re.dom7Listeners
          ? (ae = re.dom7Listeners[ne])
          : K && re.dom7LiveListeners && (ae = re.dom7LiveListeners[ne]),
          ae && ae.length)
      )
        for (let le = ae.length - 1; le >= 0; le -= 1) {
          const de = ae[le];
          (Q && de.listener === Q) ||
            (Q &&
              de.listener &&
              de.listener.dom7proxy &&
              de.listener.dom7proxy === Q)
            ? (re.removeEventListener(ne, de.proxyListener, ee),
              ae.splice(le, 1))
            : Q ||
            (re.removeEventListener(ne, de.proxyListener, ee),
              ae.splice(le, 1));
        }
    }
  }
  return this;
}
function trigger(...U) {
  const N = getWindow(),
    K = U[0].split(" "),
    Q = U[1];
  for (let ee = 0; ee < K.length; ee += 1) {
    const te = K[ee];
    for (let ie = 0; ie < this.length; ie += 1) {
      const ne = this[ie];
      if (N.CustomEvent) {
        const se = new N.CustomEvent(te, {
          detail: Q,
          bubbles: !0,
          cancelable: !0,
        });
        (ne.dom7EventData = U.filter((re, ae) => ae > 0)),
          ne.dispatchEvent(se),
          (ne.dom7EventData = []),
          delete ne.dom7EventData;
      }
    }
  }
  return this;
}
function transitionEnd$1(U) {
  const N = this;
  function K(Q) {
    Q.target === this && (U.call(this, Q), N.off("transitionend", K));
  }
  return U && N.on("transitionend", K), this;
}
function outerWidth(U) {
  if (this.length > 0) {
    if (U) {
      const N = this.styles();
      return (
        this[0].offsetWidth +
        parseFloat(N.getPropertyValue("margin-right")) +
        parseFloat(N.getPropertyValue("margin-left"))
      );
    }
    return this[0].offsetWidth;
  }
  return null;
}
function outerHeight(U) {
  if (this.length > 0) {
    if (U) {
      const N = this.styles();
      return (
        this[0].offsetHeight +
        parseFloat(N.getPropertyValue("margin-top")) +
        parseFloat(N.getPropertyValue("margin-bottom"))
      );
    }
    return this[0].offsetHeight;
  }
  return null;
}
function offset() {
  if (this.length > 0) {
    const U = getWindow(),
      N = getDocument(),
      K = this[0],
      Q = K.getBoundingClientRect(),
      ee = N.body,
      te = K.clientTop || ee.clientTop || 0,
      ie = K.clientLeft || ee.clientLeft || 0,
      ne = K === U ? U.scrollY : K.scrollTop,
      se = K === U ? U.scrollX : K.scrollLeft;
    return { top: Q.top + ne - te, left: Q.left + se - ie };
  }
  return null;
}
function styles() {
  const U = getWindow();
  return this[0] ? U.getComputedStyle(this[0], null) : {};
}
function css(U, N) {
  const K = getWindow();
  let Q;
  if (arguments.length === 1)
    if (typeof U == "string") {
      if (this[0]) return K.getComputedStyle(this[0], null).getPropertyValue(U);
    } else {
      for (Q = 0; Q < this.length; Q += 1)
        for (const ee in U) this[Q].style[ee] = U[ee];
      return this;
    }
  if (arguments.length === 2 && typeof U == "string") {
    for (Q = 0; Q < this.length; Q += 1) this[Q].style[U] = N;
    return this;
  }
  return this;
}
function each(U) {
  return U
    ? (this.forEach((N, K) => {
      U.apply(N, [N, K]);
    }),
      this)
    : this;
}
function filter(U) {
  const N = arrayFilter(this, U);
  return $(N);
}
function html(U) {
  if (typeof U == "undefined") return this[0] ? this[0].innerHTML : null;
  for (let N = 0; N < this.length; N += 1) this[N].innerHTML = U;
  return this;
}
function text(U) {
  if (typeof U == "undefined")
    return this[0] ? this[0].textContent.trim() : null;
  for (let N = 0; N < this.length; N += 1) this[N].textContent = U;
  return this;
}
function is(U) {
  const N = getWindow(),
    K = getDocument(),
    Q = this[0];
  let ee, te;
  if (!Q || typeof U == "undefined") return !1;
  if (typeof U == "string") {
    if (Q.matches) return Q.matches(U);
    if (Q.webkitMatchesSelector) return Q.webkitMatchesSelector(U);
    if (Q.msMatchesSelector) return Q.msMatchesSelector(U);
    for (ee = $(U), te = 0; te < ee.length; te += 1)
      if (ee[te] === Q) return !0;
    return !1;
  }
  if (U === K) return Q === K;
  if (U === N) return Q === N;
  if (U.nodeType || U instanceof Dom7) {
    for (ee = U.nodeType ? [U] : U, te = 0; te < ee.length; te += 1)
      if (ee[te] === Q) return !0;
    return !1;
  }
  return !1;
}
function index() {
  let U = this[0],
    N;
  if (U) {
    for (N = 0; (U = U.previousSibling) !== null;)
      U.nodeType === 1 && (N += 1);
    return N;
  }
}
function eq(U) {
  if (typeof U == "undefined") return this;
  const N = this.length;
  if (U > N - 1) return $([]);
  if (U < 0) {
    const K = N + U;
    return K < 0 ? $([]) : $([this[K]]);
  }
  return $([this[U]]);
}
function append(...U) {
  let N;
  const K = getDocument();
  for (let Q = 0; Q < U.length; Q += 1) {
    N = U[Q];
    for (let ee = 0; ee < this.length; ee += 1)
      if (typeof N == "string") {
        const te = K.createElement("div");
        for (te.innerHTML = N; te.firstChild;)
          this[ee].appendChild(te.firstChild);
      } else if (N instanceof Dom7)
        for (let te = 0; te < N.length; te += 1) this[ee].appendChild(N[te]);
      else this[ee].appendChild(N);
  }
  return this;
}
function prepend(U) {
  const N = getDocument();
  let K, Q;
  for (K = 0; K < this.length; K += 1)
    if (typeof U == "string") {
      const ee = N.createElement("div");
      for (ee.innerHTML = U, Q = ee.childNodes.length - 1; Q >= 0; Q -= 1)
        this[K].insertBefore(ee.childNodes[Q], this[K].childNodes[0]);
    } else if (U instanceof Dom7)
      for (Q = 0; Q < U.length; Q += 1)
        this[K].insertBefore(U[Q], this[K].childNodes[0]);
    else this[K].insertBefore(U, this[K].childNodes[0]);
  return this;
}
function next(U) {
  return this.length > 0
    ? U
      ? this[0].nextElementSibling && $(this[0].nextElementSibling).is(U)
        ? $([this[0].nextElementSibling])
        : $([])
      : this[0].nextElementSibling
        ? $([this[0].nextElementSibling])
        : $([])
    : $([]);
}
function nextAll(U) {
  const N = [];
  let K = this[0];
  if (!K) return $([]);
  for (; K.nextElementSibling;) {
    const Q = K.nextElementSibling;
    U ? $(Q).is(U) && N.push(Q) : N.push(Q), (K = Q);
  }
  return $(N);
}
function prev(U) {
  if (this.length > 0) {
    const N = this[0];
    return U
      ? N.previousElementSibling && $(N.previousElementSibling).is(U)
        ? $([N.previousElementSibling])
        : $([])
      : N.previousElementSibling
        ? $([N.previousElementSibling])
        : $([]);
  }
  return $([]);
}
function prevAll(U) {
  const N = [];
  let K = this[0];
  if (!K) return $([]);
  for (; K.previousElementSibling;) {
    const Q = K.previousElementSibling;
    U ? $(Q).is(U) && N.push(Q) : N.push(Q), (K = Q);
  }
  return $(N);
}
function parent(U) {
  const N = [];
  for (let K = 0; K < this.length; K += 1)
    this[K].parentNode !== null &&
      (U
        ? $(this[K].parentNode).is(U) && N.push(this[K].parentNode)
        : N.push(this[K].parentNode));
  return $(N);
}
function parents(U) {
  const N = [];
  for (let K = 0; K < this.length; K += 1) {
    let Q = this[K].parentNode;
    for (; Q;) U ? $(Q).is(U) && N.push(Q) : N.push(Q), (Q = Q.parentNode);
  }
  return $(N);
}
function closest(U) {
  let N = this;
  return typeof U == "undefined"
    ? $([])
    : (N.is(U) || (N = N.parents(U).eq(0)), N);
}
function find(U) {
  const N = [];
  for (let K = 0; K < this.length; K += 1) {
    const Q = this[K].querySelectorAll(U);
    for (let ee = 0; ee < Q.length; ee += 1) N.push(Q[ee]);
  }
  return $(N);
}
function children(U) {
  const N = [];
  for (let K = 0; K < this.length; K += 1) {
    const Q = this[K].children;
    for (let ee = 0; ee < Q.length; ee += 1)
      (!U || $(Q[ee]).is(U)) && N.push(Q[ee]);
  }
  return $(N);
}
function remove() {
  for (let U = 0; U < this.length; U += 1)
    this[U].parentNode && this[U].parentNode.removeChild(this[U]);
  return this;
}
const Methods = {
  addClass,
  removeClass,
  hasClass,
  toggleClass,
  attr,
  removeAttr,
  transform,
  transition: transition$1,
  on,
  off,
  trigger,
  transitionEnd: transitionEnd$1,
  outerWidth,
  outerHeight,
  styles,
  offset,
  css,
  each,
  html,
  text,
  is,
  index,
  eq,
  append,
  prepend,
  next,
  nextAll,
  prev,
  prevAll,
  parent,
  parents,
  closest,
  find,
  children,
  filter,
  remove,
};
Object.keys(Methods).forEach((U) => {
  Object.defineProperty($.fn, U, { value: Methods[U], writable: !0 });
});
function deleteProps(U) {
  const N = U;
  Object.keys(N).forEach((K) => {
    try {
      N[K] = null;
    } catch { }
    try {
      delete N[K];
    } catch { }
  });
}
function nextTick(U, N) {
  return N === void 0 && (N = 0), setTimeout(U, N);
}
function now() {
  return Date.now();
}
function getComputedStyle$1(U) {
  const N = getWindow();
  let K;
  return (
    N.getComputedStyle && (K = N.getComputedStyle(U, null)),
    !K && U.currentStyle && (K = U.currentStyle),
    K || (K = U.style),
    K
  );
}
function getTranslate(U, N) {
  N === void 0 && (N = "x");
  const K = getWindow();
  let Q, ee, te;
  const ie = getComputedStyle$1(U);
  return (
    K.WebKitCSSMatrix
      ? ((ee = ie.transform || ie.webkitTransform),
        ee.split(",").length > 6 &&
        (ee = ee
          .split(", ")
          .map((ne) => ne.replace(",", "."))
          .join(", ")),
        (te = new K.WebKitCSSMatrix(ee === "none" ? "" : ee)))
      : ((te =
        ie.MozTransform ||
        ie.OTransform ||
        ie.MsTransform ||
        ie.msTransform ||
        ie.transform ||
        ie
          .getPropertyValue("transform")
          .replace("translate(", "matrix(1, 0, 0, 1,")),
        (Q = te.toString().split(","))),
    N === "x" &&
    (K.WebKitCSSMatrix
      ? (ee = te.m41)
      : Q.length === 16
        ? (ee = parseFloat(Q[12]))
        : (ee = parseFloat(Q[4]))),
    N === "y" &&
    (K.WebKitCSSMatrix
      ? (ee = te.m42)
      : Q.length === 16
        ? (ee = parseFloat(Q[13]))
        : (ee = parseFloat(Q[5]))),
    ee || 0
  );
}
function isObject(U) {
  return (
    typeof U == "object" &&
    U !== null &&
    U.constructor &&
    Object.prototype.toString.call(U).slice(8, -1) === "Object"
  );
}
function isNode(U) {
  return typeof window != "undefined" &&
    typeof window.HTMLElement != "undefined"
    ? U instanceof HTMLElement
    : U && (U.nodeType === 1 || U.nodeType === 11);
}
function extend() {
  const U = Object(arguments.length <= 0 ? void 0 : arguments[0]),
    N = ["__proto__", "constructor", "prototype"];
  for (let K = 1; K < arguments.length; K += 1) {
    const Q = K < 0 || arguments.length <= K ? void 0 : arguments[K];
    if (Q != null && !isNode(Q)) {
      const ee = Object.keys(Object(Q)).filter((te) => N.indexOf(te) < 0);
      for (let te = 0, ie = ee.length; te < ie; te += 1) {
        const ne = ee[te],
          se = Object.getOwnPropertyDescriptor(Q, ne);
        se !== void 0 &&
          se.enumerable &&
          (isObject(U[ne]) && isObject(Q[ne])
            ? Q[ne].__swiper__
              ? (U[ne] = Q[ne])
              : extend(U[ne], Q[ne])
            : !isObject(U[ne]) && isObject(Q[ne])
              ? ((U[ne] = {}),
                Q[ne].__swiper__ ? (U[ne] = Q[ne]) : extend(U[ne], Q[ne]))
              : (U[ne] = Q[ne]));
      }
    }
  }
  return U;
}
function setCSSProperty(U, N, K) {
  U.style.setProperty(N, K);
}
function animateCSSModeScroll(U) {
  let { swiper: N, targetPosition: K, side: Q } = U;
  const ee = getWindow(),
    te = -N.translate;
  let ie = null,
    ne;
  const se = N.params.speed;
  (N.wrapperEl.style.scrollSnapType = "none"),
    ee.cancelAnimationFrame(N.cssModeFrameID);
  const re = K > te ? "next" : "prev",
    ae = (de, pe) => (re === "next" && de >= pe) || (re === "prev" && de <= pe),
    le = () => {
      (ne = new Date().getTime()), ie === null && (ie = ne);
      const de = Math.max(Math.min((ne - ie) / se, 1), 0),
        pe = 0.5 - Math.cos(de * Math.PI) / 2;
      let ue = te + pe * (K - te);
      if (
        (ae(ue, K) && (ue = K), N.wrapperEl.scrollTo({ [Q]: ue }), ae(ue, K))
      ) {
        (N.wrapperEl.style.overflow = "hidden"),
          (N.wrapperEl.style.scrollSnapType = ""),
          setTimeout(() => {
            (N.wrapperEl.style.overflow = ""),
              N.wrapperEl.scrollTo({ [Q]: ue });
          }),
          ee.cancelAnimationFrame(N.cssModeFrameID);
        return;
      }
      N.cssModeFrameID = ee.requestAnimationFrame(le);
    };
  le();
}
let support;
function calcSupport() {
  const U = getWindow(),
    N = getDocument();
  return {
    smoothScroll:
      N.documentElement && "scrollBehavior" in N.documentElement.style,
    touch: !!(
      "ontouchstart" in U ||
      (U.DocumentTouch && N instanceof U.DocumentTouch)
    ),
    passiveListener: (function () {
      let Q = !1;
      try {
        const ee = Object.defineProperty({}, "passive", {
          get() {
            Q = !0;
          },
        });
        U.addEventListener("testPassiveListener", null, ee);
      } catch { }
      return Q;
    })(),
    gestures: (function () {
      return "ongesturestart" in U;
    })(),
  };
}
function getSupport() {
  return support || (support = calcSupport()), support;
}
let deviceCached;
function calcDevice(U) {
  let { userAgent: N } = U === void 0 ? {} : U;
  const K = getSupport(),
    Q = getWindow(),
    ee = Q.navigator.platform,
    te = N || Q.navigator.userAgent,
    ie = { ios: !1, android: !1 },
    ne = Q.screen.width,
    se = Q.screen.height,
    re = te.match(/(Android);?[\s\/]+([\d.]+)?/);
  let ae = te.match(/(iPad).*OS\s([\d_]+)/);
  const le = te.match(/(iPod)(.*OS\s([\d_]+))?/),
    de = !ae && te.match(/(iPhone\sOS|iOS)\s([\d_]+)/),
    pe = ee === "Win32";
  let ue = ee === "MacIntel";
  const fe = [
    "1024x1366",
    "1366x1024",
    "834x1194",
    "1194x834",
    "834x1112",
    "1112x834",
    "768x1024",
    "1024x768",
    "820x1180",
    "1180x820",
    "810x1080",
    "1080x810",
  ];
  return (
    !ae &&
    ue &&
    K.touch &&
    fe.indexOf(`${ne}x${se}`) >= 0 &&
    ((ae = te.match(/(Version)\/([\d.]+)/)),
      ae || (ae = [0, 1, "13_0_0"]),
      (ue = !1)),
    re && !pe && ((ie.os = "android"), (ie.android = !0)),
    (ae || de || le) && ((ie.os = "ios"), (ie.ios = !0)),
    ie
  );
}
function getDevice(U) {
  return (
    U === void 0 && (U = {}),
    deviceCached || (deviceCached = calcDevice(U)),
    deviceCached
  );
}
let browser;
function calcBrowser() {
  const U = getWindow();
  function N() {
    const K = U.navigator.userAgent.toLowerCase();
    return (
      K.indexOf("safari") >= 0 &&
      K.indexOf("chrome") < 0 &&
      K.indexOf("android") < 0
    );
  }
  return {
    isSafari: N(),
    isWebView: /(iPhone|iPod|iPad).*AppleWebKit(?!.*Safari)/i.test(
      U.navigator.userAgent
    ),
  };
}
function getBrowser() {
  return browser || (browser = calcBrowser()), browser;
}
function Resize(U) {
  let { swiper: N, on: K, emit: Q } = U;
  const ee = getWindow();
  let te = null,
    ie = null;
  const ne = () => {
    !N || N.destroyed || !N.initialized || (Q("beforeResize"), Q("resize"));
  },
    se = () => {
      !N ||
        N.destroyed ||
        !N.initialized ||
        ((te = new ResizeObserver((le) => {
          ie = ee.requestAnimationFrame(() => {
            const { width: de, height: pe } = N;
            let ue = de,
              fe = pe;
            le.forEach((oe) => {
              let { contentBoxSize: ce, contentRect: he, target: me } = oe;
              (me && me !== N.el) ||
                ((ue = he ? he.width : (ce[0] || ce).inlineSize),
                  (fe = he ? he.height : (ce[0] || ce).blockSize));
            }),
              (ue !== de || fe !== pe) && ne();
          });
        })),
          te.observe(N.el));
    },
    re = () => {
      ie && ee.cancelAnimationFrame(ie),
        te && te.unobserve && N.el && (te.unobserve(N.el), (te = null));
    },
    ae = () => {
      !N || N.destroyed || !N.initialized || Q("orientationchange");
    };
  K("init", () => {
    if (N.params.resizeObserver && typeof ee.ResizeObserver != "undefined") {
      se();
      return;
    }
    ee.addEventListener("resize", ne),
      ee.addEventListener("orientationchange", ae);
  }),
    K("destroy", () => {
      re(),
        ee.removeEventListener("resize", ne),
        ee.removeEventListener("orientationchange", ae);
    });
}
function Observer(U) {
  let { swiper: N, extendParams: K, on: Q, emit: ee } = U;
  const te = [],
    ie = getWindow(),
    ne = function (ae, le) {
      le === void 0 && (le = {});
      const de = ie.MutationObserver || ie.WebkitMutationObserver,
        pe = new de((ue) => {
          if (ue.length === 1) {
            ee("observerUpdate", ue[0]);
            return;
          }
          const fe = function () {
            ee("observerUpdate", ue[0]);
          };
          ie.requestAnimationFrame
            ? ie.requestAnimationFrame(fe)
            : ie.setTimeout(fe, 0);
        });
      pe.observe(ae, {
        attributes: typeof le.attributes == "undefined" ? !0 : le.attributes,
        childList: typeof le.childList == "undefined" ? !0 : le.childList,
        characterData:
          typeof le.characterData == "undefined" ? !0 : le.characterData,
      }),
        te.push(pe);
    },
    se = () => {
      if (!!N.params.observer) {
        if (N.params.observeParents) {
          const ae = N.$el.parents();
          for (let le = 0; le < ae.length; le += 1) ne(ae[le]);
        }
        ne(N.$el[0], { childList: N.params.observeSlideChildren }),
          ne(N.$wrapperEl[0], { attributes: !1 });
      }
    },
    re = () => {
      te.forEach((ae) => {
        ae.disconnect();
      }),
        te.splice(0, te.length);
    };
  K({ observer: !1, observeParents: !1, observeSlideChildren: !1 }),
    Q("init", se),
    Q("destroy", re);
}
var eventsEmitter = {
  on(U, N, K) {
    const Q = this;
    if (!Q.eventsListeners || Q.destroyed || typeof N != "function") return Q;
    const ee = K ? "unshift" : "push";
    return (
      U.split(" ").forEach((te) => {
        Q.eventsListeners[te] || (Q.eventsListeners[te] = []),
          Q.eventsListeners[te][ee](N);
      }),
      Q
    );
  },
  once(U, N, K) {
    const Q = this;
    if (!Q.eventsListeners || Q.destroyed || typeof N != "function") return Q;
    function ee() {
      Q.off(U, ee), ee.__emitterProxy && delete ee.__emitterProxy;
      for (var te = arguments.length, ie = new Array(te), ne = 0; ne < te; ne++)
        ie[ne] = arguments[ne];
      N.apply(Q, ie);
    }
    return (ee.__emitterProxy = N), Q.on(U, ee, K);
  },
  onAny(U, N) {
    const K = this;
    if (!K.eventsListeners || K.destroyed || typeof U != "function") return K;
    const Q = N ? "unshift" : "push";
    return K.eventsAnyListeners.indexOf(U) < 0 && K.eventsAnyListeners[Q](U), K;
  },
  offAny(U) {
    const N = this;
    if (!N.eventsListeners || N.destroyed || !N.eventsAnyListeners) return N;
    const K = N.eventsAnyListeners.indexOf(U);
    return K >= 0 && N.eventsAnyListeners.splice(K, 1), N;
  },
  off(U, N) {
    const K = this;
    return (
      !K.eventsListeners ||
      K.destroyed ||
      !K.eventsListeners ||
      U.split(" ").forEach((Q) => {
        typeof N == "undefined"
          ? (K.eventsListeners[Q] = [])
          : K.eventsListeners[Q] &&
          K.eventsListeners[Q].forEach((ee, te) => {
            (ee === N || (ee.__emitterProxy && ee.__emitterProxy === N)) &&
              K.eventsListeners[Q].splice(te, 1);
          });
      }),
      K
    );
  },
  emit() {
    const U = this;
    if (!U.eventsListeners || U.destroyed || !U.eventsListeners) return U;
    let N, K, Q;
    for (var ee = arguments.length, te = new Array(ee), ie = 0; ie < ee; ie++)
      te[ie] = arguments[ie];
    return (
      typeof te[0] == "string" || Array.isArray(te[0])
        ? ((N = te[0]), (K = te.slice(1, te.length)), (Q = U))
        : ((N = te[0].events), (K = te[0].data), (Q = te[0].context || U)),
      K.unshift(Q),
      (Array.isArray(N) ? N : N.split(" ")).forEach((se) => {
        U.eventsAnyListeners &&
          U.eventsAnyListeners.length &&
          U.eventsAnyListeners.forEach((re) => {
            re.apply(Q, [se, ...K]);
          }),
          U.eventsListeners &&
          U.eventsListeners[se] &&
          U.eventsListeners[se].forEach((re) => {
            re.apply(Q, K);
          });
      }),
      U
    );
  },
};
function updateSize() {
  const U = this;
  let N, K;
  const Q = U.$el;
  typeof U.params.width != "undefined" && U.params.width !== null
    ? (N = U.params.width)
    : (N = Q[0].clientWidth),
    typeof U.params.height != "undefined" && U.params.height !== null
      ? (K = U.params.height)
      : (K = Q[0].clientHeight),
    !((N === 0 && U.isHorizontal()) || (K === 0 && U.isVertical())) &&
    ((N =
      N -
      parseInt(Q.css("padding-left") || 0, 10) -
      parseInt(Q.css("padding-right") || 0, 10)),
      (K =
        K -
        parseInt(Q.css("padding-top") || 0, 10) -
        parseInt(Q.css("padding-bottom") || 0, 10)),
      Number.isNaN(N) && (N = 0),
      Number.isNaN(K) && (K = 0),
      Object.assign(U, {
        width: N,
        height: K,
        size: U.isHorizontal() ? N : K,
      }));
}
function updateSlides() {
  const U = this;
  function N($e) {
    return U.isHorizontal()
      ? $e
      : {
        width: "height",
        "margin-top": "margin-left",
        "margin-bottom ": "margin-right",
        "margin-left": "margin-top",
        "margin-right": "margin-bottom",
        "padding-left": "padding-top",
        "padding-right": "padding-bottom",
        marginRight: "marginBottom",
      }[$e];
  }
  function K($e, ve) {
    return parseFloat($e.getPropertyValue(N(ve)) || 0);
  }
  const Q = U.params,
    { $wrapperEl: ee, size: te, rtlTranslate: ie, wrongRTL: ne } = U,
    se = U.virtual && Q.virtual.enabled,
    re = se ? U.virtual.slides.length : U.slides.length,
    ae = ee.children(`.${U.params.slideClass}`),
    le = se ? U.virtual.slides.length : ae.length;
  let de = [];
  const pe = [],
    ue = [];
  let fe = Q.slidesOffsetBefore;
  typeof fe == "function" && (fe = Q.slidesOffsetBefore.call(U));
  let oe = Q.slidesOffsetAfter;
  typeof oe == "function" && (oe = Q.slidesOffsetAfter.call(U));
  const ce = U.snapGrid.length,
    he = U.slidesGrid.length;
  let me = Q.spaceBetween,
    ge = -fe,
    Se = 0,
    be = 0;
  if (typeof te == "undefined") return;
  typeof me == "string" &&
    me.indexOf("%") >= 0 &&
    (me = (parseFloat(me.replace("%", "")) / 100) * te),
    (U.virtualSize = -me),
    ie
      ? ae.css({ marginLeft: "", marginBottom: "", marginTop: "" })
      : ae.css({ marginRight: "", marginBottom: "", marginTop: "" }),
    Q.centeredSlides &&
    Q.cssMode &&
    (setCSSProperty(U.wrapperEl, "--swiper-centered-offset-before", ""),
      setCSSProperty(U.wrapperEl, "--swiper-centered-offset-after", ""));
  const Te = Q.grid && Q.grid.rows > 1 && U.grid;
  Te && U.grid.initSlides(le);
  let ye;
  const Ce =
    Q.slidesPerView === "auto" &&
    Q.breakpoints &&
    Object.keys(Q.breakpoints).filter(
      ($e) => typeof Q.breakpoints[$e].slidesPerView != "undefined"
    ).length > 0;
  for (let $e = 0; $e < le; $e += 1) {
    ye = 0;
    const ve = ae.eq($e);
    if (
      (Te && U.grid.updateSlide($e, ve, le, N), ve.css("display") !== "none")
    ) {
      if (Q.slidesPerView === "auto") {
        Ce && (ae[$e].style[N("width")] = "");
        const we = getComputedStyle(ve[0]),
          xe = ve[0].style.transform,
          Ee = ve[0].style.webkitTransform;
        if (
          (xe && (ve[0].style.transform = "none"),
            Ee && (ve[0].style.webkitTransform = "none"),
            Q.roundLengths)
        )
          ye = U.isHorizontal() ? ve.outerWidth(!0) : ve.outerHeight(!0);
        else {
          const Me = K(we, "width"),
            Ae = K(we, "padding-left"),
            ze = K(we, "padding-right"),
            Pe = K(we, "margin-left"),
            Le = K(we, "margin-right"),
            ke = we.getPropertyValue("box-sizing");
          if (ke && ke === "border-box") ye = Me + Pe + Le;
          else {
            const { clientWidth: Ne, offsetWidth: Fe } = ve[0];
            ye = Me + Ae + ze + Pe + Le + (Fe - Ne);
          }
        }
        xe && (ve[0].style.transform = xe),
          Ee && (ve[0].style.webkitTransform = Ee),
          Q.roundLengths && (ye = Math.floor(ye));
      } else
        (ye = (te - (Q.slidesPerView - 1) * me) / Q.slidesPerView),
          Q.roundLengths && (ye = Math.floor(ye)),
          ae[$e] && (ae[$e].style[N("width")] = `${ye}px`);
      ae[$e] && (ae[$e].swiperSlideSize = ye),
        ue.push(ye),
        Q.centeredSlides
          ? ((ge = ge + ye / 2 + Se / 2 + me),
            Se === 0 && $e !== 0 && (ge = ge - te / 2 - me),
            $e === 0 && (ge = ge - te / 2 - me),
            Math.abs(ge) < 1 / 1e3 && (ge = 0),
            Q.roundLengths && (ge = Math.floor(ge)),
            be % Q.slidesPerGroup === 0 && de.push(ge),
            pe.push(ge))
          : (Q.roundLengths && (ge = Math.floor(ge)),
            (be - Math.min(U.params.slidesPerGroupSkip, be)) %
            U.params.slidesPerGroup ===
            0 && de.push(ge),
            pe.push(ge),
            (ge = ge + ye + me)),
        (U.virtualSize += ye + me),
        (Se = ye),
        (be += 1);
    }
  }
  if (
    ((U.virtualSize = Math.max(U.virtualSize, te) + oe),
      ie &&
      ne &&
      (Q.effect === "slide" || Q.effect === "coverflow") &&
      ee.css({ width: `${U.virtualSize + Q.spaceBetween}px` }),
      Q.setWrapperSize &&
      ee.css({ [N("width")]: `${U.virtualSize + Q.spaceBetween}px` }),
      Te && U.grid.updateWrapperSize(ye, de, N),
      !Q.centeredSlides)
  ) {
    const $e = [];
    for (let ve = 0; ve < de.length; ve += 1) {
      let we = de[ve];
      Q.roundLengths && (we = Math.floor(we)),
        de[ve] <= U.virtualSize - te && $e.push(we);
    }
    (de = $e),
      Math.floor(U.virtualSize - te) - Math.floor(de[de.length - 1]) > 1 &&
      de.push(U.virtualSize - te);
  }
  if ((de.length === 0 && (de = [0]), Q.spaceBetween !== 0)) {
    const $e = U.isHorizontal() && ie ? "marginLeft" : N("marginRight");
    ae.filter((ve, we) => (Q.cssMode ? we !== ae.length - 1 : !0)).css({
      [$e]: `${me}px`,
    });
  }
  if (Q.centeredSlides && Q.centeredSlidesBounds) {
    let $e = 0;
    ue.forEach((we) => {
      $e += we + (Q.spaceBetween ? Q.spaceBetween : 0);
    }),
      ($e -= Q.spaceBetween);
    const ve = $e - te;
    de = de.map((we) => (we < 0 ? -fe : we > ve ? ve + oe : we));
  }
  if (Q.centerInsufficientSlides) {
    let $e = 0;
    if (
      (ue.forEach((ve) => {
        $e += ve + (Q.spaceBetween ? Q.spaceBetween : 0);
      }),
        ($e -= Q.spaceBetween),
        $e < te)
    ) {
      const ve = (te - $e) / 2;
      de.forEach((we, xe) => {
        de[xe] = we - ve;
      }),
        pe.forEach((we, xe) => {
          pe[xe] = we + ve;
        });
    }
  }
  if (
    (Object.assign(U, {
      slides: ae,
      snapGrid: de,
      slidesGrid: pe,
      slidesSizesGrid: ue,
    }),
      Q.centeredSlides && Q.cssMode && !Q.centeredSlidesBounds)
  ) {
    setCSSProperty(
      U.wrapperEl,
      "--swiper-centered-offset-before",
      `${-de[0]}px`
    ),
      setCSSProperty(
        U.wrapperEl,
        "--swiper-centered-offset-after",
        `${U.size / 2 - ue[ue.length - 1] / 2}px`
      );
    const $e = -U.snapGrid[0],
      ve = -U.slidesGrid[0];
    (U.snapGrid = U.snapGrid.map((we) => we + $e)),
      (U.slidesGrid = U.slidesGrid.map((we) => we + ve));
  }
  if (
    (le !== re && U.emit("slidesLengthChange"),
      de.length !== ce &&
      (U.params.watchOverflow && U.checkOverflow(),
        U.emit("snapGridLengthChange")),
      pe.length !== he && U.emit("slidesGridLengthChange"),
      Q.watchSlidesProgress && U.updateSlidesOffset(),
      !se && !Q.cssMode && (Q.effect === "slide" || Q.effect === "fade"))
  ) {
    const $e = `${Q.containerModifierClass}backface-hidden`,
      ve = U.$el.hasClass($e);
    le <= Q.maxBackfaceHiddenSlides
      ? ve || U.$el.addClass($e)
      : ve && U.$el.removeClass($e);
  }
}
function updateAutoHeight(U) {
  const N = this,
    K = [],
    Q = N.virtual && N.params.virtual.enabled;
  let ee = 0,
    te;
  typeof U == "number"
    ? N.setTransition(U)
    : U === !0 && N.setTransition(N.params.speed);
  const ie = (ne) =>
    Q
      ? N.slides.filter(
        (se) =>
          parseInt(se.getAttribute("data-swiper-slide-index"), 10) === ne
      )[0]
      : N.slides.eq(ne)[0];
  if (N.params.slidesPerView !== "auto" && N.params.slidesPerView > 1)
    if (N.params.centeredSlides)
      (N.visibleSlides || $([])).each((ne) => {
        K.push(ne);
      });
    else
      for (te = 0; te < Math.ceil(N.params.slidesPerView); te += 1) {
        const ne = N.activeIndex + te;
        if (ne > N.slides.length && !Q) break;
        K.push(ie(ne));
      }
  else K.push(ie(N.activeIndex));
  for (te = 0; te < K.length; te += 1)
    if (typeof K[te] != "undefined") {
      const ne = K[te].offsetHeight;
      ee = ne > ee ? ne : ee;
    }
  (ee || ee === 0) && N.$wrapperEl.css("height", `${ee}px`);
}
function updateSlidesOffset() {
  const U = this,
    N = U.slides;
  for (let K = 0; K < N.length; K += 1)
    N[K].swiperSlideOffset = U.isHorizontal()
      ? N[K].offsetLeft
      : N[K].offsetTop;
}
function updateSlidesProgress(U) {
  U === void 0 && (U = (this && this.translate) || 0);
  const N = this,
    K = N.params,
    { slides: Q, rtlTranslate: ee, snapGrid: te } = N;
  if (Q.length === 0) return;
  typeof Q[0].swiperSlideOffset == "undefined" && N.updateSlidesOffset();
  let ie = -U;
  ee && (ie = U),
    Q.removeClass(K.slideVisibleClass),
    (N.visibleSlidesIndexes = []),
    (N.visibleSlides = []);
  for (let ne = 0; ne < Q.length; ne += 1) {
    const se = Q[ne];
    let re = se.swiperSlideOffset;
    K.cssMode && K.centeredSlides && (re -= Q[0].swiperSlideOffset);
    const ae =
      (ie + (K.centeredSlides ? N.minTranslate() : 0) - re) /
      (se.swiperSlideSize + K.spaceBetween),
      le =
        (ie - te[0] + (K.centeredSlides ? N.minTranslate() : 0) - re) /
        (se.swiperSlideSize + K.spaceBetween),
      de = -(ie - re),
      pe = de + N.slidesSizesGrid[ne];
    ((de >= 0 && de < N.size - 1) ||
      (pe > 1 && pe <= N.size) ||
      (de <= 0 && pe >= N.size)) &&
      (N.visibleSlides.push(se),
        N.visibleSlidesIndexes.push(ne),
        Q.eq(ne).addClass(K.slideVisibleClass)),
      (se.progress = ee ? -ae : ae),
      (se.originalProgress = ee ? -le : le);
  }
  N.visibleSlides = $(N.visibleSlides);
}
function updateProgress(U) {
  const N = this;
  if (typeof U == "undefined") {
    const re = N.rtlTranslate ? -1 : 1;
    U = (N && N.translate && N.translate * re) || 0;
  }
  const K = N.params,
    Q = N.maxTranslate() - N.minTranslate();
  let { progress: ee, isBeginning: te, isEnd: ie } = N;
  const ne = te,
    se = ie;
  Q === 0
    ? ((ee = 0), (te = !0), (ie = !0))
    : ((ee = (U - N.minTranslate()) / Q), (te = ee <= 0), (ie = ee >= 1)),
    Object.assign(N, { progress: ee, isBeginning: te, isEnd: ie }),
    (K.watchSlidesProgress || (K.centeredSlides && K.autoHeight)) &&
    N.updateSlidesProgress(U),
    te && !ne && N.emit("reachBeginning toEdge"),
    ie && !se && N.emit("reachEnd toEdge"),
    ((ne && !te) || (se && !ie)) && N.emit("fromEdge"),
    N.emit("progress", ee);
}
function updateSlidesClasses() {
  const U = this,
    { slides: N, params: K, $wrapperEl: Q, activeIndex: ee, realIndex: te } = U,
    ie = U.virtual && K.virtual.enabled;
  N.removeClass(
    `${K.slideActiveClass} ${K.slideNextClass} ${K.slidePrevClass} ${K.slideDuplicateActiveClass} ${K.slideDuplicateNextClass} ${K.slideDuplicatePrevClass}`
  );
  let ne;
  ie
    ? (ne = U.$wrapperEl.find(
      `.${K.slideClass}[data-swiper-slide-index="${ee}"]`
    ))
    : (ne = N.eq(ee)),
    ne.addClass(K.slideActiveClass),
    K.loop &&
    (ne.hasClass(K.slideDuplicateClass)
      ? Q.children(
        `.${K.slideClass}:not(.${K.slideDuplicateClass})[data-swiper-slide-index="${te}"]`
      ).addClass(K.slideDuplicateActiveClass)
      : Q.children(
        `.${K.slideClass}.${K.slideDuplicateClass}[data-swiper-slide-index="${te}"]`
      ).addClass(K.slideDuplicateActiveClass));
  let se = ne.nextAll(`.${K.slideClass}`).eq(0).addClass(K.slideNextClass);
  K.loop && se.length === 0 && ((se = N.eq(0)), se.addClass(K.slideNextClass));
  let re = ne.prevAll(`.${K.slideClass}`).eq(0).addClass(K.slidePrevClass);
  K.loop && re.length === 0 && ((re = N.eq(-1)), re.addClass(K.slidePrevClass)),
    K.loop &&
    (se.hasClass(K.slideDuplicateClass)
      ? Q.children(
        `.${K.slideClass}:not(.${K.slideDuplicateClass
        })[data-swiper-slide-index="${se.attr("data-swiper-slide-index")}"]`
      ).addClass(K.slideDuplicateNextClass)
      : Q.children(
        `.${K.slideClass}.${K.slideDuplicateClass
        }[data-swiper-slide-index="${se.attr("data-swiper-slide-index")}"]`
      ).addClass(K.slideDuplicateNextClass),
      re.hasClass(K.slideDuplicateClass)
        ? Q.children(
          `.${K.slideClass}:not(.${K.slideDuplicateClass
          })[data-swiper-slide-index="${re.attr("data-swiper-slide-index")}"]`
        ).addClass(K.slideDuplicatePrevClass)
        : Q.children(
          `.${K.slideClass}.${K.slideDuplicateClass
          }[data-swiper-slide-index="${re.attr("data-swiper-slide-index")}"]`
        ).addClass(K.slideDuplicatePrevClass)),
    U.emitSlidesClasses();
}
function updateActiveIndex(U) {
  const N = this,
    K = N.rtlTranslate ? N.translate : -N.translate,
    {
      slidesGrid: Q,
      snapGrid: ee,
      params: te,
      activeIndex: ie,
      realIndex: ne,
      snapIndex: se,
    } = N;
  let re = U,
    ae;
  if (typeof re == "undefined") {
    for (let de = 0; de < Q.length; de += 1)
      typeof Q[de + 1] != "undefined"
        ? K >= Q[de] && K < Q[de + 1] - (Q[de + 1] - Q[de]) / 2
          ? (re = de)
          : K >= Q[de] && K < Q[de + 1] && (re = de + 1)
        : K >= Q[de] && (re = de);
    te.normalizeSlideIndex && (re < 0 || typeof re == "undefined") && (re = 0);
  }
  if (ee.indexOf(K) >= 0) ae = ee.indexOf(K);
  else {
    const de = Math.min(te.slidesPerGroupSkip, re);
    ae = de + Math.floor((re - de) / te.slidesPerGroup);
  }
  if ((ae >= ee.length && (ae = ee.length - 1), re === ie)) {
    ae !== se && ((N.snapIndex = ae), N.emit("snapIndexChange"));
    return;
  }
  const le = parseInt(
    N.slides.eq(re).attr("data-swiper-slide-index") || re,
    10
  );
  Object.assign(N, {
    snapIndex: ae,
    realIndex: le,
    previousIndex: ie,
    activeIndex: re,
  }),
    N.emit("activeIndexChange"),
    N.emit("snapIndexChange"),
    ne !== le && N.emit("realIndexChange"),
    (N.initialized || N.params.runCallbacksOnInit) && N.emit("slideChange");
}
function updateClickedSlide(U) {
  const N = this,
    K = N.params,
    Q = $(U).closest(`.${K.slideClass}`)[0];
  let ee = !1,
    te;
  if (Q) {
    for (let ie = 0; ie < N.slides.length; ie += 1)
      if (N.slides[ie] === Q) {
        (ee = !0), (te = ie);
        break;
      }
  }
  if (Q && ee)
    (N.clickedSlide = Q),
      N.virtual && N.params.virtual.enabled
        ? (N.clickedIndex = parseInt($(Q).attr("data-swiper-slide-index"), 10))
        : (N.clickedIndex = te);
  else {
    (N.clickedSlide = void 0), (N.clickedIndex = void 0);
    return;
  }
  K.slideToClickedSlide &&
    N.clickedIndex !== void 0 &&
    N.clickedIndex !== N.activeIndex &&
    N.slideToClickedSlide();
}
var update = {
  updateSize,
  updateSlides,
  updateAutoHeight,
  updateSlidesOffset,
  updateSlidesProgress,
  updateProgress,
  updateSlidesClasses,
  updateActiveIndex,
  updateClickedSlide,
};
function getSwiperTranslate(U) {
  U === void 0 && (U = this.isHorizontal() ? "x" : "y");
  const N = this,
    { params: K, rtlTranslate: Q, translate: ee, $wrapperEl: te } = N;
  if (K.virtualTranslate) return Q ? -ee : ee;
  if (K.cssMode) return ee;
  let ie = getTranslate(te[0], U);
  return Q && (ie = -ie), ie || 0;
}
function setTranslate(U, N) {
  const K = this,
    {
      rtlTranslate: Q,
      params: ee,
      $wrapperEl: te,
      wrapperEl: ie,
      progress: ne,
    } = K;
  let se = 0,
    re = 0;
  const ae = 0;
  K.isHorizontal() ? (se = Q ? -U : U) : (re = U),
    ee.roundLengths && ((se = Math.floor(se)), (re = Math.floor(re))),
    ee.cssMode
      ? (ie[K.isHorizontal() ? "scrollLeft" : "scrollTop"] = K.isHorizontal()
        ? -se
        : -re)
      : ee.virtualTranslate ||
      te.transform(`translate3d(${se}px, ${re}px, ${ae}px)`),
    (K.previousTranslate = K.translate),
    (K.translate = K.isHorizontal() ? se : re);
  let le;
  const de = K.maxTranslate() - K.minTranslate();
  de === 0 ? (le = 0) : (le = (U - K.minTranslate()) / de),
    le !== ne && K.updateProgress(U),
    K.emit("setTranslate", K.translate, N);
}
function minTranslate() {
  return -this.snapGrid[0];
}
function maxTranslate() {
  return -this.snapGrid[this.snapGrid.length - 1];
}
function translateTo(U, N, K, Q, ee) {
  U === void 0 && (U = 0),
    N === void 0 && (N = this.params.speed),
    K === void 0 && (K = !0),
    Q === void 0 && (Q = !0);
  const te = this,
    { params: ie, wrapperEl: ne } = te;
  if (te.animating && ie.preventInteractionOnTransition) return !1;
  const se = te.minTranslate(),
    re = te.maxTranslate();
  let ae;
  if (
    (Q && U > se ? (ae = se) : Q && U < re ? (ae = re) : (ae = U),
      te.updateProgress(ae),
      ie.cssMode)
  ) {
    const le = te.isHorizontal();
    if (N === 0) ne[le ? "scrollLeft" : "scrollTop"] = -ae;
    else {
      if (!te.support.smoothScroll)
        return (
          animateCSSModeScroll({
            swiper: te,
            targetPosition: -ae,
            side: le ? "left" : "top",
          }),
          !0
        );
      ne.scrollTo({ [le ? "left" : "top"]: -ae, behavior: "smooth" });
    }
    return !0;
  }
  return (
    N === 0
      ? (te.setTransition(0),
        te.setTranslate(ae),
        K &&
        (te.emit("beforeTransitionStart", N, ee), te.emit("transitionEnd")))
      : (te.setTransition(N),
        te.setTranslate(ae),
        K &&
        (te.emit("beforeTransitionStart", N, ee), te.emit("transitionStart")),
        te.animating ||
        ((te.animating = !0),
          te.onTranslateToWrapperTransitionEnd ||
          (te.onTranslateToWrapperTransitionEnd = function (de) {
            !te ||
              te.destroyed ||
              (de.target === this &&
                (te.$wrapperEl[0].removeEventListener(
                  "transitionend",
                  te.onTranslateToWrapperTransitionEnd
                ),
                  te.$wrapperEl[0].removeEventListener(
                    "webkitTransitionEnd",
                    te.onTranslateToWrapperTransitionEnd
                  ),
                  (te.onTranslateToWrapperTransitionEnd = null),
                  delete te.onTranslateToWrapperTransitionEnd,
                  K && te.emit("transitionEnd")));
          }),
          te.$wrapperEl[0].addEventListener(
            "transitionend",
            te.onTranslateToWrapperTransitionEnd
          ),
          te.$wrapperEl[0].addEventListener(
            "webkitTransitionEnd",
            te.onTranslateToWrapperTransitionEnd
          ))),
    !0
  );
}
var translate = {
  getTranslate: getSwiperTranslate,
  setTranslate,
  minTranslate,
  maxTranslate,
  translateTo,
};
function setTransition(U, N) {
  const K = this;
  K.params.cssMode || K.$wrapperEl.transition(U), K.emit("setTransition", U, N);
}
function transitionEmit(U) {
  let { swiper: N, runCallbacks: K, direction: Q, step: ee } = U;
  const { activeIndex: te, previousIndex: ie } = N;
  let ne = Q;
  if (
    (ne || (te > ie ? (ne = "next") : te < ie ? (ne = "prev") : (ne = "reset")),
      N.emit(`transition${ee}`),
      K && te !== ie)
  ) {
    if (ne === "reset") {
      N.emit(`slideResetTransition${ee}`);
      return;
    }
    N.emit(`slideChangeTransition${ee}`),
      ne === "next"
        ? N.emit(`slideNextTransition${ee}`)
        : N.emit(`slidePrevTransition${ee}`);
  }
}
function transitionStart(U, N) {
  U === void 0 && (U = !0);
  const K = this,
    { params: Q } = K;
  Q.cssMode ||
    (Q.autoHeight && K.updateAutoHeight(),
      transitionEmit({
        swiper: K,
        runCallbacks: U,
        direction: N,
        step: "Start",
      }));
}
function transitionEnd(U, N) {
  U === void 0 && (U = !0);
  const K = this,
    { params: Q } = K;
  (K.animating = !1),
    !Q.cssMode &&
    (K.setTransition(0),
      transitionEmit({
        swiper: K,
        runCallbacks: U,
        direction: N,
        step: "End",
      }));
}
var transition = { setTransition, transitionStart, transitionEnd };
function slideTo(U, N, K, Q, ee) {
  if (
    (U === void 0 && (U = 0),
      N === void 0 && (N = this.params.speed),
      K === void 0 && (K = !0),
      typeof U != "number" && typeof U != "string")
  )
    throw new Error(
      `The 'index' argument cannot have type other than 'number' or 'string'. [${typeof U}] given.`
    );
  if (typeof U == "string") {
    const me = parseInt(U, 10);
    if (!isFinite(me))
      throw new Error(
        `The passed-in 'index' (string) couldn't be converted to 'number'. [${U}] given.`
      );
    U = me;
  }
  const te = this;
  let ie = U;
  ie < 0 && (ie = 0);
  const {
    params: ne,
    snapGrid: se,
    slidesGrid: re,
    previousIndex: ae,
    activeIndex: le,
    rtlTranslate: de,
    wrapperEl: pe,
    enabled: ue,
  } = te;
  if ((te.animating && ne.preventInteractionOnTransition) || (!ue && !Q && !ee))
    return !1;
  const fe = Math.min(te.params.slidesPerGroupSkip, ie);
  let oe = fe + Math.floor((ie - fe) / te.params.slidesPerGroup);
  oe >= se.length && (oe = se.length - 1),
    (le || ne.initialSlide || 0) === (ae || 0) &&
    K &&
    te.emit("beforeSlideChangeStart");
  const ce = -se[oe];
  if ((te.updateProgress(ce), ne.normalizeSlideIndex))
    for (let me = 0; me < re.length; me += 1) {
      const ge = -Math.floor(ce * 100),
        Se = Math.floor(re[me] * 100),
        be = Math.floor(re[me + 1] * 100);
      typeof re[me + 1] != "undefined"
        ? ge >= Se && ge < be - (be - Se) / 2
          ? (ie = me)
          : ge >= Se && ge < be && (ie = me + 1)
        : ge >= Se && (ie = me);
    }
  if (
    te.initialized &&
    ie !== le &&
    ((!te.allowSlideNext && ce < te.translate && ce < te.minTranslate()) ||
      (!te.allowSlidePrev &&
        ce > te.translate &&
        ce > te.maxTranslate() &&
        (le || 0) !== ie))
  )
    return !1;
  let he;
  if (
    (ie > le ? (he = "next") : ie < le ? (he = "prev") : (he = "reset"),
      (de && -ce === te.translate) || (!de && ce === te.translate))
  )
    return (
      te.updateActiveIndex(ie),
      ne.autoHeight && te.updateAutoHeight(),
      te.updateSlidesClasses(),
      ne.effect !== "slide" && te.setTranslate(ce),
      he !== "reset" && (te.transitionStart(K, he), te.transitionEnd(K, he)),
      !1
    );
  if (ne.cssMode) {
    const me = te.isHorizontal(),
      ge = de ? ce : -ce;
    if (N === 0) {
      const Se = te.virtual && te.params.virtual.enabled;
      Se &&
        ((te.wrapperEl.style.scrollSnapType = "none"),
          (te._immediateVirtual = !0)),
        (pe[me ? "scrollLeft" : "scrollTop"] = ge),
        Se &&
        requestAnimationFrame(() => {
          (te.wrapperEl.style.scrollSnapType = ""),
            (te._swiperImmediateVirtual = !1);
        });
    } else {
      if (!te.support.smoothScroll)
        return (
          animateCSSModeScroll({
            swiper: te,
            targetPosition: ge,
            side: me ? "left" : "top",
          }),
          !0
        );
      pe.scrollTo({ [me ? "left" : "top"]: ge, behavior: "smooth" });
    }
    return !0;
  }
  return (
    te.setTransition(N),
    te.setTranslate(ce),
    te.updateActiveIndex(ie),
    te.updateSlidesClasses(),
    te.emit("beforeTransitionStart", N, Q),
    te.transitionStart(K, he),
    N === 0
      ? te.transitionEnd(K, he)
      : te.animating ||
      ((te.animating = !0),
        te.onSlideToWrapperTransitionEnd ||
        (te.onSlideToWrapperTransitionEnd = function (ge) {
          !te ||
            te.destroyed ||
            (ge.target === this &&
              (te.$wrapperEl[0].removeEventListener(
                "transitionend",
                te.onSlideToWrapperTransitionEnd
              ),
                te.$wrapperEl[0].removeEventListener(
                  "webkitTransitionEnd",
                  te.onSlideToWrapperTransitionEnd
                ),
                (te.onSlideToWrapperTransitionEnd = null),
                delete te.onSlideToWrapperTransitionEnd,
                te.transitionEnd(K, he)));
        }),
        te.$wrapperEl[0].addEventListener(
          "transitionend",
          te.onSlideToWrapperTransitionEnd
        ),
        te.$wrapperEl[0].addEventListener(
          "webkitTransitionEnd",
          te.onSlideToWrapperTransitionEnd
        )),
    !0
  );
}
function slideToLoop(U, N, K, Q) {
  if (
    (U === void 0 && (U = 0),
      N === void 0 && (N = this.params.speed),
      K === void 0 && (K = !0),
      typeof U == "string")
  ) {
    const ie = parseInt(U, 10);
    if (!isFinite(ie))
      throw new Error(
        `The passed-in 'index' (string) couldn't be converted to 'number'. [${U}] given.`
      );
    U = ie;
  }
  const ee = this;
  let te = U;
  return ee.params.loop && (te += ee.loopedSlides), ee.slideTo(te, N, K, Q);
}
function slideNext(U, N, K) {
  U === void 0 && (U = this.params.speed), N === void 0 && (N = !0);
  const Q = this,
    { animating: ee, enabled: te, params: ie } = Q;
  if (!te) return Q;
  let ne = ie.slidesPerGroup;
  ie.slidesPerView === "auto" &&
    ie.slidesPerGroup === 1 &&
    ie.slidesPerGroupAuto &&
    (ne = Math.max(Q.slidesPerViewDynamic("current", !0), 1));
  const se = Q.activeIndex < ie.slidesPerGroupSkip ? 1 : ne;
  if (ie.loop) {
    if (ee && ie.loopPreventsSlide) return !1;
    Q.loopFix(), (Q._clientLeft = Q.$wrapperEl[0].clientLeft);
  }
  return ie.rewind && Q.isEnd
    ? Q.slideTo(0, U, N, K)
    : Q.slideTo(Q.activeIndex + se, U, N, K);
}
function slidePrev(U, N, K) {
  U === void 0 && (U = this.params.speed), N === void 0 && (N = !0);
  const Q = this,
    {
      params: ee,
      animating: te,
      snapGrid: ie,
      slidesGrid: ne,
      rtlTranslate: se,
      enabled: re,
    } = Q;
  if (!re) return Q;
  if (ee.loop) {
    if (te && ee.loopPreventsSlide) return !1;
    Q.loopFix(), (Q._clientLeft = Q.$wrapperEl[0].clientLeft);
  }
  const ae = se ? Q.translate : -Q.translate;
  function le(oe) {
    return oe < 0 ? -Math.floor(Math.abs(oe)) : Math.floor(oe);
  }
  const de = le(ae),
    pe = ie.map((oe) => le(oe));
  let ue = ie[pe.indexOf(de) - 1];
  if (typeof ue == "undefined" && ee.cssMode) {
    let oe;
    ie.forEach((ce, he) => {
      de >= ce && (oe = he);
    }),
      typeof oe != "undefined" && (ue = ie[oe > 0 ? oe - 1 : oe]);
  }
  let fe = 0;
  if (
    (typeof ue != "undefined" &&
      ((fe = ne.indexOf(ue)),
        fe < 0 && (fe = Q.activeIndex - 1),
        ee.slidesPerView === "auto" &&
        ee.slidesPerGroup === 1 &&
        ee.slidesPerGroupAuto &&
        ((fe = fe - Q.slidesPerViewDynamic("previous", !0) + 1),
          (fe = Math.max(fe, 0)))),
      ee.rewind && Q.isBeginning)
  ) {
    const oe =
      Q.params.virtual && Q.params.virtual.enabled && Q.virtual
        ? Q.virtual.slides.length - 1
        : Q.slides.length - 1;
    return Q.slideTo(oe, U, N, K);
  }
  return Q.slideTo(fe, U, N, K);
}
function slideReset(U, N, K) {
  U === void 0 && (U = this.params.speed), N === void 0 && (N = !0);
  const Q = this;
  return Q.slideTo(Q.activeIndex, U, N, K);
}
function slideToClosest(U, N, K, Q) {
  U === void 0 && (U = this.params.speed),
    N === void 0 && (N = !0),
    Q === void 0 && (Q = 0.5);
  const ee = this;
  let te = ee.activeIndex;
  const ie = Math.min(ee.params.slidesPerGroupSkip, te),
    ne = ie + Math.floor((te - ie) / ee.params.slidesPerGroup),
    se = ee.rtlTranslate ? ee.translate : -ee.translate;
  if (se >= ee.snapGrid[ne]) {
    const re = ee.snapGrid[ne],
      ae = ee.snapGrid[ne + 1];
    se - re > (ae - re) * Q && (te += ee.params.slidesPerGroup);
  } else {
    const re = ee.snapGrid[ne - 1],
      ae = ee.snapGrid[ne];
    se - re <= (ae - re) * Q && (te -= ee.params.slidesPerGroup);
  }
  return (
    (te = Math.max(te, 0)),
    (te = Math.min(te, ee.slidesGrid.length - 1)),
    ee.slideTo(te, U, N, K)
  );
}
function slideToClickedSlide() {
  const U = this,
    { params: N, $wrapperEl: K } = U,
    Q = N.slidesPerView === "auto" ? U.slidesPerViewDynamic() : N.slidesPerView;
  let ee = U.clickedIndex,
    te;
  if (N.loop) {
    if (U.animating) return;
    (te = parseInt($(U.clickedSlide).attr("data-swiper-slide-index"), 10)),
      N.centeredSlides
        ? ee < U.loopedSlides - Q / 2 ||
          ee > U.slides.length - U.loopedSlides + Q / 2
          ? (U.loopFix(),
            (ee = K.children(
              `.${N.slideClass}[data-swiper-slide-index="${te}"]:not(.${N.slideDuplicateClass})`
            )
              .eq(0)
              .index()),
            nextTick(() => {
              U.slideTo(ee);
            }))
          : U.slideTo(ee)
        : ee > U.slides.length - Q
          ? (U.loopFix(),
            (ee = K.children(
              `.${N.slideClass}[data-swiper-slide-index="${te}"]:not(.${N.slideDuplicateClass})`
            )
              .eq(0)
              .index()),
            nextTick(() => {
              U.slideTo(ee);
            }))
          : U.slideTo(ee);
  } else U.slideTo(ee);
}
var slide = {
  slideTo,
  slideToLoop,
  slideNext,
  slidePrev,
  slideReset,
  slideToClosest,
  slideToClickedSlide,
};
function loopCreate() {
  const U = this,
    N = getDocument(),
    { params: K, $wrapperEl: Q } = U,
    ee = Q.children().length > 0 ? $(Q.children()[0].parentNode) : Q;
  ee.children(`.${K.slideClass}.${K.slideDuplicateClass}`).remove();
  let te = ee.children(`.${K.slideClass}`);
  if (K.loopFillGroupWithBlank) {
    const se = K.slidesPerGroup - (te.length % K.slidesPerGroup);
    if (se !== K.slidesPerGroup) {
      for (let re = 0; re < se; re += 1) {
        const ae = $(N.createElement("div")).addClass(
          `${K.slideClass} ${K.slideBlankClass}`
        );
        ee.append(ae);
      }
      te = ee.children(`.${K.slideClass}`);
    }
  }
  K.slidesPerView === "auto" && !K.loopedSlides && (K.loopedSlides = te.length),
    (U.loopedSlides = Math.ceil(
      parseFloat(K.loopedSlides || K.slidesPerView, 10)
    )),
    (U.loopedSlides += K.loopAdditionalSlides),
    U.loopedSlides > te.length && (U.loopedSlides = te.length);
  const ie = [],
    ne = [];
  te.each((se, re) => {
    const ae = $(se);
    re < U.loopedSlides && ne.push(se),
      re < te.length && re >= te.length - U.loopedSlides && ie.push(se),
      ae.attr("data-swiper-slide-index", re);
  });
  for (let se = 0; se < ne.length; se += 1)
    ee.append($(ne[se].cloneNode(!0)).addClass(K.slideDuplicateClass));
  for (let se = ie.length - 1; se >= 0; se -= 1)
    ee.prepend($(ie[se].cloneNode(!0)).addClass(K.slideDuplicateClass));
}
function loopFix() {
  const U = this;
  U.emit("beforeLoopFix");
  const {
    activeIndex: N,
    slides: K,
    loopedSlides: Q,
    allowSlidePrev: ee,
    allowSlideNext: te,
    snapGrid: ie,
    rtlTranslate: ne,
  } = U;
  let se;
  (U.allowSlidePrev = !0), (U.allowSlideNext = !0);
  const ae = -ie[N] - U.getTranslate();
  N < Q
    ? ((se = K.length - Q * 3 + N),
      (se += Q),
      U.slideTo(se, 0, !1, !0) &&
      ae !== 0 &&
      U.setTranslate((ne ? -U.translate : U.translate) - ae))
    : N >= K.length - Q &&
    ((se = -K.length + N + Q),
      (se += Q),
      U.slideTo(se, 0, !1, !0) &&
      ae !== 0 &&
      U.setTranslate((ne ? -U.translate : U.translate) - ae)),
    (U.allowSlidePrev = ee),
    (U.allowSlideNext = te),
    U.emit("loopFix");
}
function loopDestroy() {
  const U = this,
    { $wrapperEl: N, params: K, slides: Q } = U;
  N.children(
    `.${K.slideClass}.${K.slideDuplicateClass},.${K.slideClass}.${K.slideBlankClass}`
  ).remove(),
    Q.removeAttr("data-swiper-slide-index");
}
var loop = { loopCreate, loopFix, loopDestroy };
function setGrabCursor(U) {
  const N = this;
  if (
    N.support.touch ||
    !N.params.simulateTouch ||
    (N.params.watchOverflow && N.isLocked) ||
    N.params.cssMode
  )
    return;
  const K = N.params.touchEventsTarget === "container" ? N.el : N.wrapperEl;
  (K.style.cursor = "move"), (K.style.cursor = U ? "grabbing" : "grab");
}
function unsetGrabCursor() {
  const U = this;
  U.support.touch ||
    (U.params.watchOverflow && U.isLocked) ||
    U.params.cssMode ||
    (U[
      U.params.touchEventsTarget === "container" ? "el" : "wrapperEl"
    ].style.cursor = "");
}
var grabCursor = { setGrabCursor, unsetGrabCursor };
function closestElement(U, N) {
  N === void 0 && (N = this);
  function K(Q) {
    if (!Q || Q === getDocument() || Q === getWindow()) return null;
    Q.assignedSlot && (Q = Q.assignedSlot);
    const ee = Q.closest(U);
    return !ee && !Q.getRootNode ? null : ee || K(Q.getRootNode().host);
  }
  return K(N);
}
function onTouchStart(U) {
  const N = this,
    K = getDocument(),
    Q = getWindow(),
    ee = N.touchEventsData,
    { params: te, touches: ie, enabled: ne } = N;
  if (!ne || (N.animating && te.preventInteractionOnTransition)) return;
  !N.animating && te.cssMode && te.loop && N.loopFix();
  let se = U;
  se.originalEvent && (se = se.originalEvent);
  let re = $(se.target);
  if (
    (te.touchEventsTarget === "wrapper" && !re.closest(N.wrapperEl).length) ||
    ((ee.isTouchEvent = se.type === "touchstart"),
      !ee.isTouchEvent && "which" in se && se.which === 3) ||
    (!ee.isTouchEvent && "button" in se && se.button > 0) ||
    (ee.isTouched && ee.isMoved)
  )
    return;
  !!te.noSwipingClass &&
    te.noSwipingClass !== "" &&
    se.target &&
    se.target.shadowRoot &&
    U.path &&
    U.path[0] &&
    (re = $(U.path[0]));
  const le = te.noSwipingSelector
    ? te.noSwipingSelector
    : `.${te.noSwipingClass}`,
    de = !!(se.target && se.target.shadowRoot);
  if (te.noSwiping && (de ? closestElement(le, re[0]) : re.closest(le)[0])) {
    N.allowClick = !0;
    return;
  }
  if (te.swipeHandler && !re.closest(te.swipeHandler)[0]) return;
  (ie.currentX =
    se.type === "touchstart" ? se.targetTouches[0].pageX : se.pageX),
    (ie.currentY =
      se.type === "touchstart" ? se.targetTouches[0].pageY : se.pageY);
  const pe = ie.currentX,
    ue = ie.currentY,
    fe = te.edgeSwipeDetection || te.iOSEdgeSwipeDetection,
    oe = te.edgeSwipeThreshold || te.iOSEdgeSwipeThreshold;
  if (fe && (pe <= oe || pe >= Q.innerWidth - oe))
    if (fe === "prevent") U.preventDefault();
    else return;
  if (
    (Object.assign(ee, {
      isTouched: !0,
      isMoved: !1,
      allowTouchCallbacks: !0,
      isScrolling: void 0,
      startMoving: void 0,
    }),
      (ie.startX = pe),
      (ie.startY = ue),
      (ee.touchStartTime = now()),
      (N.allowClick = !0),
      N.updateSize(),
      (N.swipeDirection = void 0),
      te.threshold > 0 && (ee.allowThresholdMove = !1),
      se.type !== "touchstart")
  ) {
    let ce = !0;
    re.is(ee.focusableElements) &&
      ((ce = !1), re[0].nodeName === "SELECT" && (ee.isTouched = !1)),
      K.activeElement &&
      $(K.activeElement).is(ee.focusableElements) &&
      K.activeElement !== re[0] &&
      K.activeElement.blur();
    const he = ce && N.allowTouchMove && te.touchStartPreventDefault;
    (te.touchStartForcePreventDefault || he) &&
      !re[0].isContentEditable &&
      se.preventDefault();
  }
  N.params.freeMode &&
    N.params.freeMode.enabled &&
    N.freeMode &&
    N.animating &&
    !te.cssMode &&
    N.freeMode.onTouchStart(),
    N.emit("touchStart", se);
}
function onTouchMove(U) {
  const N = getDocument(),
    K = this,
    Q = K.touchEventsData,
    { params: ee, touches: te, rtlTranslate: ie, enabled: ne } = K;
  if (!ne) return;
  let se = U;
  if ((se.originalEvent && (se = se.originalEvent), !Q.isTouched)) {
    Q.startMoving && Q.isScrolling && K.emit("touchMoveOpposite", se);
    return;
  }
  if (Q.isTouchEvent && se.type !== "touchmove") return;
  const re =
    se.type === "touchmove" &&
    se.targetTouches &&
    (se.targetTouches[0] || se.changedTouches[0]),
    ae = se.type === "touchmove" ? re.pageX : se.pageX,
    le = se.type === "touchmove" ? re.pageY : se.pageY;
  if (se.preventedByNestedSwiper) {
    (te.startX = ae), (te.startY = le);
    return;
  }
  if (!K.allowTouchMove) {
    $(se.target).is(Q.focusableElements) || (K.allowClick = !1),
      Q.isTouched &&
      (Object.assign(te, {
        startX: ae,
        startY: le,
        currentX: ae,
        currentY: le,
      }),
        (Q.touchStartTime = now()));
    return;
  }
  if (Q.isTouchEvent && ee.touchReleaseOnEdges && !ee.loop) {
    if (K.isVertical()) {
      if (
        (le < te.startY && K.translate <= K.maxTranslate()) ||
        (le > te.startY && K.translate >= K.minTranslate())
      ) {
        (Q.isTouched = !1), (Q.isMoved = !1);
        return;
      }
    } else if (
      (ae < te.startX && K.translate <= K.maxTranslate()) ||
      (ae > te.startX && K.translate >= K.minTranslate())
    )
      return;
  }
  if (
    Q.isTouchEvent &&
    N.activeElement &&
    se.target === N.activeElement &&
    $(se.target).is(Q.focusableElements)
  ) {
    (Q.isMoved = !0), (K.allowClick = !1);
    return;
  }
  if (
    (Q.allowTouchCallbacks && K.emit("touchMove", se),
      se.targetTouches && se.targetTouches.length > 1)
  )
    return;
  (te.currentX = ae), (te.currentY = le);
  const de = te.currentX - te.startX,
    pe = te.currentY - te.startY;
  if (K.params.threshold && Math.sqrt(de ** 2 + pe ** 2) < K.params.threshold)
    return;
  if (typeof Q.isScrolling == "undefined") {
    let ce;
    (K.isHorizontal() && te.currentY === te.startY) ||
      (K.isVertical() && te.currentX === te.startX)
      ? (Q.isScrolling = !1)
      : de * de + pe * pe >= 25 &&
      ((ce = (Math.atan2(Math.abs(pe), Math.abs(de)) * 180) / Math.PI),
        (Q.isScrolling = K.isHorizontal()
          ? ce > ee.touchAngle
          : 90 - ce > ee.touchAngle));
  }
  if (
    (Q.isScrolling && K.emit("touchMoveOpposite", se),
      typeof Q.startMoving == "undefined" &&
      (te.currentX !== te.startX || te.currentY !== te.startY) &&
      (Q.startMoving = !0),
      Q.isScrolling)
  ) {
    Q.isTouched = !1;
    return;
  }
  if (!Q.startMoving) return;
  (K.allowClick = !1),
    !ee.cssMode && se.cancelable && se.preventDefault(),
    ee.touchMoveStopPropagation && !ee.nested && se.stopPropagation(),
    Q.isMoved ||
    (ee.loop && !ee.cssMode && K.loopFix(),
      (Q.startTranslate = K.getTranslate()),
      K.setTransition(0),
      K.animating && K.$wrapperEl.trigger("webkitTransitionEnd transitionend"),
      (Q.allowMomentumBounce = !1),
      ee.grabCursor &&
      (K.allowSlideNext === !0 || K.allowSlidePrev === !0) &&
      K.setGrabCursor(!0),
      K.emit("sliderFirstMove", se)),
    K.emit("sliderMove", se),
    (Q.isMoved = !0);
  let ue = K.isHorizontal() ? de : pe;
  (te.diff = ue),
    (ue *= ee.touchRatio),
    ie && (ue = -ue),
    (K.swipeDirection = ue > 0 ? "prev" : "next"),
    (Q.currentTranslate = ue + Q.startTranslate);
  let fe = !0,
    oe = ee.resistanceRatio;
  if (
    (ee.touchReleaseOnEdges && (oe = 0),
      ue > 0 && Q.currentTranslate > K.minTranslate()
        ? ((fe = !1),
          ee.resistance &&
          (Q.currentTranslate =
            K.minTranslate() -
            1 +
            (-K.minTranslate() + Q.startTranslate + ue) ** oe))
        : ue < 0 &&
        Q.currentTranslate < K.maxTranslate() &&
        ((fe = !1),
          ee.resistance &&
          (Q.currentTranslate =
            K.maxTranslate() +
            1 -
            (K.maxTranslate() - Q.startTranslate - ue) ** oe)),
      fe && (se.preventedByNestedSwiper = !0),
      !K.allowSlideNext &&
      K.swipeDirection === "next" &&
      Q.currentTranslate < Q.startTranslate &&
      (Q.currentTranslate = Q.startTranslate),
      !K.allowSlidePrev &&
      K.swipeDirection === "prev" &&
      Q.currentTranslate > Q.startTranslate &&
      (Q.currentTranslate = Q.startTranslate),
      !K.allowSlidePrev &&
      !K.allowSlideNext &&
      (Q.currentTranslate = Q.startTranslate),
      ee.threshold > 0)
  )
    if (Math.abs(ue) > ee.threshold || Q.allowThresholdMove) {
      if (!Q.allowThresholdMove) {
        (Q.allowThresholdMove = !0),
          (te.startX = te.currentX),
          (te.startY = te.currentY),
          (Q.currentTranslate = Q.startTranslate),
          (te.diff = K.isHorizontal()
            ? te.currentX - te.startX
            : te.currentY - te.startY);
        return;
      }
    } else {
      Q.currentTranslate = Q.startTranslate;
      return;
    }
  !ee.followFinger ||
    ee.cssMode ||
    (((ee.freeMode && ee.freeMode.enabled && K.freeMode) ||
      ee.watchSlidesProgress) &&
      (K.updateActiveIndex(), K.updateSlidesClasses()),
      K.params.freeMode &&
      ee.freeMode.enabled &&
      K.freeMode &&
      K.freeMode.onTouchMove(),
      K.updateProgress(Q.currentTranslate),
      K.setTranslate(Q.currentTranslate));
}
function onTouchEnd(U) {
  const N = this,
    K = N.touchEventsData,
    {
      params: Q,
      touches: ee,
      rtlTranslate: te,
      slidesGrid: ie,
      enabled: ne,
    } = N;
  if (!ne) return;
  let se = U;
  if (
    (se.originalEvent && (se = se.originalEvent),
      K.allowTouchCallbacks && N.emit("touchEnd", se),
      (K.allowTouchCallbacks = !1),
      !K.isTouched)
  ) {
    K.isMoved && Q.grabCursor && N.setGrabCursor(!1),
      (K.isMoved = !1),
      (K.startMoving = !1);
    return;
  }
  Q.grabCursor &&
    K.isMoved &&
    K.isTouched &&
    (N.allowSlideNext === !0 || N.allowSlidePrev === !0) &&
    N.setGrabCursor(!1);
  const re = now(),
    ae = re - K.touchStartTime;
  if (N.allowClick) {
    const he = se.path || (se.composedPath && se.composedPath());
    N.updateClickedSlide((he && he[0]) || se.target),
      N.emit("tap click", se),
      ae < 300 &&
      re - K.lastClickTime < 300 &&
      N.emit("doubleTap doubleClick", se);
  }
  if (
    ((K.lastClickTime = now()),
      nextTick(() => {
        N.destroyed || (N.allowClick = !0);
      }),
      !K.isTouched ||
      !K.isMoved ||
      !N.swipeDirection ||
      ee.diff === 0 ||
      K.currentTranslate === K.startTranslate)
  ) {
    (K.isTouched = !1), (K.isMoved = !1), (K.startMoving = !1);
    return;
  }
  (K.isTouched = !1), (K.isMoved = !1), (K.startMoving = !1);
  let le;
  if (
    (Q.followFinger
      ? (le = te ? N.translate : -N.translate)
      : (le = -K.currentTranslate),
      Q.cssMode)
  )
    return;
  if (N.params.freeMode && Q.freeMode.enabled) {
    N.freeMode.onTouchEnd({ currentPos: le });
    return;
  }
  let de = 0,
    pe = N.slidesSizesGrid[0];
  for (
    let he = 0;
    he < ie.length;
    he += he < Q.slidesPerGroupSkip ? 1 : Q.slidesPerGroup
  ) {
    const me = he < Q.slidesPerGroupSkip - 1 ? 1 : Q.slidesPerGroup;
    typeof ie[he + me] != "undefined"
      ? le >= ie[he] &&
      le < ie[he + me] &&
      ((de = he), (pe = ie[he + me] - ie[he]))
      : le >= ie[he] &&
      ((de = he), (pe = ie[ie.length - 1] - ie[ie.length - 2]));
  }
  let ue = null,
    fe = null;
  Q.rewind &&
    (N.isBeginning
      ? (fe =
        N.params.virtual && N.params.virtual.enabled && N.virtual
          ? N.virtual.slides.length - 1
          : N.slides.length - 1)
      : N.isEnd && (ue = 0));
  const oe = (le - ie[de]) / pe,
    ce = de < Q.slidesPerGroupSkip - 1 ? 1 : Q.slidesPerGroup;
  if (ae > Q.longSwipesMs) {
    if (!Q.longSwipes) {
      N.slideTo(N.activeIndex);
      return;
    }
    N.swipeDirection === "next" &&
      (oe >= Q.longSwipesRatio
        ? N.slideTo(Q.rewind && N.isEnd ? ue : de + ce)
        : N.slideTo(de)),
      N.swipeDirection === "prev" &&
      (oe > 1 - Q.longSwipesRatio
        ? N.slideTo(de + ce)
        : fe !== null && oe < 0 && Math.abs(oe) > Q.longSwipesRatio
          ? N.slideTo(fe)
          : N.slideTo(de));
  } else {
    if (!Q.shortSwipes) {
      N.slideTo(N.activeIndex);
      return;
    }
    N.navigation &&
      (se.target === N.navigation.nextEl || se.target === N.navigation.prevEl)
      ? se.target === N.navigation.nextEl
        ? N.slideTo(de + ce)
        : N.slideTo(de)
      : (N.swipeDirection === "next" && N.slideTo(ue !== null ? ue : de + ce),
        N.swipeDirection === "prev" && N.slideTo(fe !== null ? fe : de));
  }
}
function onResize() {
  const U = this,
    { params: N, el: K } = U;
  if (K && K.offsetWidth === 0) return;
  N.breakpoints && U.setBreakpoint();
  const { allowSlideNext: Q, allowSlidePrev: ee, snapGrid: te } = U;
  (U.allowSlideNext = !0),
    (U.allowSlidePrev = !0),
    U.updateSize(),
    U.updateSlides(),
    U.updateSlidesClasses(),
    (N.slidesPerView === "auto" || N.slidesPerView > 1) &&
      U.isEnd &&
      !U.isBeginning &&
      !U.params.centeredSlides
      ? U.slideTo(U.slides.length - 1, 0, !1, !0)
      : U.slideTo(U.activeIndex, 0, !1, !0),
    U.autoplay && U.autoplay.running && U.autoplay.paused && U.autoplay.run(),
    (U.allowSlidePrev = ee),
    (U.allowSlideNext = Q),
    U.params.watchOverflow && te !== U.snapGrid && U.checkOverflow();
}
function onClick(U) {
  const N = this;
  !N.enabled ||
    N.allowClick ||
    (N.params.preventClicks && U.preventDefault(),
      N.params.preventClicksPropagation &&
      N.animating &&
      (U.stopPropagation(), U.stopImmediatePropagation()));
}
function onScroll() {
  const U = this,
    { wrapperEl: N, rtlTranslate: K, enabled: Q } = U;
  if (!Q) return;
  (U.previousTranslate = U.translate),
    U.isHorizontal()
      ? (U.translate = -N.scrollLeft)
      : (U.translate = -N.scrollTop),
    U.translate === 0 && (U.translate = 0),
    U.updateActiveIndex(),
    U.updateSlidesClasses();
  let ee;
  const te = U.maxTranslate() - U.minTranslate();
  te === 0 ? (ee = 0) : (ee = (U.translate - U.minTranslate()) / te),
    ee !== U.progress && U.updateProgress(K ? -U.translate : U.translate),
    U.emit("setTranslate", U.translate, !1);
}
let dummyEventAttached = !1;
function dummyEventListener() { }
const events = (U, N) => {
  const K = getDocument(),
    {
      params: Q,
      touchEvents: ee,
      el: te,
      wrapperEl: ie,
      device: ne,
      support: se,
    } = U,
    re = !!Q.nested,
    ae = N === "on" ? "addEventListener" : "removeEventListener",
    le = N;
  if (!se.touch)
    te[ae](ee.start, U.onTouchStart, !1),
      K[ae](ee.move, U.onTouchMove, re),
      K[ae](ee.end, U.onTouchEnd, !1);
  else {
    const de =
      ee.start === "touchstart" && se.passiveListener && Q.passiveListeners
        ? { passive: !0, capture: !1 }
        : !1;
    te[ae](ee.start, U.onTouchStart, de),
      te[ae](
        ee.move,
        U.onTouchMove,
        se.passiveListener ? { passive: !1, capture: re } : re
      ),
      te[ae](ee.end, U.onTouchEnd, de),
      ee.cancel && te[ae](ee.cancel, U.onTouchEnd, de);
  }
  (Q.preventClicks || Q.preventClicksPropagation) &&
    te[ae]("click", U.onClick, !0),
    Q.cssMode && ie[ae]("scroll", U.onScroll),
    Q.updateOnWindowResize
      ? U[le](
        ne.ios || ne.android
          ? "resize orientationchange observerUpdate"
          : "resize observerUpdate",
        onResize,
        !0
      )
      : U[le]("observerUpdate", onResize, !0);
};
function attachEvents() {
  const U = this,
    N = getDocument(),
    { params: K, support: Q } = U;
  (U.onTouchStart = onTouchStart.bind(U)),
    (U.onTouchMove = onTouchMove.bind(U)),
    (U.onTouchEnd = onTouchEnd.bind(U)),
    K.cssMode && (U.onScroll = onScroll.bind(U)),
    (U.onClick = onClick.bind(U)),
    Q.touch &&
    !dummyEventAttached &&
    (N.addEventListener("touchstart", dummyEventListener),
      (dummyEventAttached = !0)),
    events(U, "on");
}
function detachEvents() {
  events(this, "off");
}
var events$1 = { attachEvents, detachEvents };
const isGridEnabled = (U, N) => U.grid && N.grid && N.grid.rows > 1;
function setBreakpoint() {
  const U = this,
    {
      activeIndex: N,
      initialized: K,
      loopedSlides: Q = 0,
      params: ee,
      $el: te,
    } = U,
    ie = ee.breakpoints;
  if (!ie || (ie && Object.keys(ie).length === 0)) return;
  const ne = U.getBreakpoint(ie, U.params.breakpointsBase, U.el);
  if (!ne || U.currentBreakpoint === ne) return;
  const re = (ne in ie ? ie[ne] : void 0) || U.originalParams,
    ae = isGridEnabled(U, ee),
    le = isGridEnabled(U, re),
    de = ee.enabled;
  ae && !le
    ? (te.removeClass(
      `${ee.containerModifierClass}grid ${ee.containerModifierClass}grid-column`
    ),
      U.emitContainerClasses())
    : !ae &&
    le &&
    (te.addClass(`${ee.containerModifierClass}grid`),
      ((re.grid.fill && re.grid.fill === "column") ||
        (!re.grid.fill && ee.grid.fill === "column")) &&
      te.addClass(`${ee.containerModifierClass}grid-column`),
      U.emitContainerClasses()),
    ["navigation", "pagination", "scrollbar"].forEach((oe) => {
      const ce = ee[oe] && ee[oe].enabled,
        he = re[oe] && re[oe].enabled;
      ce && !he && U[oe].disable(), !ce && he && U[oe].enable();
    });
  const pe = re.direction && re.direction !== ee.direction,
    ue = ee.loop && (re.slidesPerView !== ee.slidesPerView || pe);
  pe && K && U.changeDirection(), extend(U.params, re);
  const fe = U.params.enabled;
  Object.assign(U, {
    allowTouchMove: U.params.allowTouchMove,
    allowSlideNext: U.params.allowSlideNext,
    allowSlidePrev: U.params.allowSlidePrev,
  }),
    de && !fe ? U.disable() : !de && fe && U.enable(),
    (U.currentBreakpoint = ne),
    U.emit("_beforeBreakpoint", re),
    ue &&
    K &&
    (U.loopDestroy(),
      U.loopCreate(),
      U.updateSlides(),
      U.slideTo(N - Q + U.loopedSlides, 0, !1)),
    U.emit("breakpoint", re);
}
function getBreakpoint(U, N, K) {
  if ((N === void 0 && (N = "window"), !U || (N === "container" && !K))) return;
  let Q = !1;
  const ee = getWindow(),
    te = N === "window" ? ee.innerHeight : K.clientHeight,
    ie = Object.keys(U).map((ne) => {
      if (typeof ne == "string" && ne.indexOf("@") === 0) {
        const se = parseFloat(ne.substr(1));
        return { value: te * se, point: ne };
      }
      return { value: ne, point: ne };
    });
  ie.sort((ne, se) => parseInt(ne.value, 10) - parseInt(se.value, 10));
  for (let ne = 0; ne < ie.length; ne += 1) {
    const { point: se, value: re } = ie[ne];
    N === "window"
      ? ee.matchMedia(`(min-width: ${re}px)`).matches && (Q = se)
      : re <= K.clientWidth && (Q = se);
  }
  return Q || "max";
}
var breakpoints = { setBreakpoint, getBreakpoint };
function prepareClasses(U, N) {
  const K = [];
  return (
    U.forEach((Q) => {
      typeof Q == "object"
        ? Object.keys(Q).forEach((ee) => {
          Q[ee] && K.push(N + ee);
        })
        : typeof Q == "string" && K.push(N + Q);
    }),
    K
  );
}
function addClasses() {
  const U = this,
    { classNames: N, params: K, rtl: Q, $el: ee, device: te, support: ie } = U,
    ne = prepareClasses(
      [
        "initialized",
        K.direction,
        { "pointer-events": !ie.touch },
        { "free-mode": U.params.freeMode && K.freeMode.enabled },
        { autoheight: K.autoHeight },
        { rtl: Q },
        { grid: K.grid && K.grid.rows > 1 },
        {
          "grid-column": K.grid && K.grid.rows > 1 && K.grid.fill === "column",
        },
        { android: te.android },
        { ios: te.ios },
        { "css-mode": K.cssMode },
        { centered: K.cssMode && K.centeredSlides },
        { "watch-progress": K.watchSlidesProgress },
      ],
      K.containerModifierClass
    );
  N.push(...ne), ee.addClass([...N].join(" ")), U.emitContainerClasses();
}
function removeClasses() {
  const U = this,
    { $el: N, classNames: K } = U;
  N.removeClass(K.join(" ")), U.emitContainerClasses();
}
var classes = { addClasses, removeClasses };
function loadImage(U, N, K, Q, ee, te) {
  const ie = getWindow();
  let ne;
  function se() {
    te && te();
  }
  !$(U).parent("picture")[0] && (!U.complete || !ee) && N
    ? ((ne = new ie.Image()),
      (ne.onload = se),
      (ne.onerror = se),
      Q && (ne.sizes = Q),
      K && (ne.srcset = K),
      N && (ne.src = N))
    : se();
}
function preloadImages() {
  const U = this;
  U.imagesToLoad = U.$el.find("img");
  function N() {
    typeof U == "undefined" ||
      U === null ||
      !U ||
      U.destroyed ||
      (U.imagesLoaded !== void 0 && (U.imagesLoaded += 1),
        U.imagesLoaded === U.imagesToLoad.length &&
        (U.params.updateOnImagesReady && U.update(), U.emit("imagesReady")));
  }
  for (let K = 0; K < U.imagesToLoad.length; K += 1) {
    const Q = U.imagesToLoad[K];
    U.loadImage(
      Q,
      Q.currentSrc || Q.getAttribute("src"),
      Q.srcset || Q.getAttribute("srcset"),
      Q.sizes || Q.getAttribute("sizes"),
      !0,
      N
    );
  }
}
var images = { loadImage, preloadImages };
function checkOverflow() {
  const U = this,
    { isLocked: N, params: K } = U,
    { slidesOffsetBefore: Q } = K;
  if (Q) {
    const ee = U.slides.length - 1,
      te = U.slidesGrid[ee] + U.slidesSizesGrid[ee] + Q * 2;
    U.isLocked = U.size > te;
  } else U.isLocked = U.snapGrid.length === 1;
  K.allowSlideNext === !0 && (U.allowSlideNext = !U.isLocked),
    K.allowSlidePrev === !0 && (U.allowSlidePrev = !U.isLocked),
    N && N !== U.isLocked && (U.isEnd = !1),
    N !== U.isLocked && U.emit(U.isLocked ? "lock" : "unlock");
}
var checkOverflow$1 = { checkOverflow },
  defaults = {
    init: !0,
    direction: "horizontal",
    touchEventsTarget: "wrapper",
    initialSlide: 0,
    speed: 300,
    cssMode: !1,
    updateOnWindowResize: !0,
    resizeObserver: !0,
    nested: !1,
    createElements: !1,
    enabled: !0,
    focusableElements: "input, select, option, textarea, button, video, label",
    width: null,
    height: null,
    preventInteractionOnTransition: !1,
    userAgent: null,
    url: null,
    edgeSwipeDetection: !1,
    edgeSwipeThreshold: 20,
    autoHeight: !1,
    setWrapperSize: !1,
    virtualTranslate: !1,
    effect: "slide",
    breakpoints: void 0,
    breakpointsBase: "window",
    spaceBetween: 0,
    slidesPerView: 1,
    slidesPerGroup: 1,
    slidesPerGroupSkip: 0,
    slidesPerGroupAuto: !1,
    centeredSlides: !1,
    centeredSlidesBounds: !1,
    slidesOffsetBefore: 0,
    slidesOffsetAfter: 0,
    normalizeSlideIndex: !0,
    centerInsufficientSlides: !1,
    watchOverflow: !0,
    roundLengths: !1,
    touchRatio: 1,
    touchAngle: 45,
    simulateTouch: !0,
    shortSwipes: !0,
    longSwipes: !0,
    longSwipesRatio: 0.5,
    longSwipesMs: 300,
    followFinger: !0,
    allowTouchMove: !0,
    threshold: 0,
    touchMoveStopPropagation: !1,
    touchStartPreventDefault: !0,
    touchStartForcePreventDefault: !1,
    touchReleaseOnEdges: !1,
    uniqueNavElements: !0,
    resistance: !0,
    resistanceRatio: 0.85,
    watchSlidesProgress: !1,
    grabCursor: !1,
    preventClicks: !0,
    preventClicksPropagation: !0,
    slideToClickedSlide: !1,
    preloadImages: !0,
    updateOnImagesReady: !0,
    loop: !1,
    loopAdditionalSlides: 0,
    loopedSlides: null,
    loopFillGroupWithBlank: !1,
    loopPreventsSlide: !0,
    rewind: !1,
    allowSlidePrev: !0,
    allowSlideNext: !0,
    swipeHandler: null,
    noSwiping: !0,
    noSwipingClass: "swiper-no-swiping",
    noSwipingSelector: null,
    passiveListeners: !0,
    maxBackfaceHiddenSlides: 10,
    containerModifierClass: "swiper-",
    slideClass: "swiper-slide",
    slideBlankClass: "swiper-slide-invisible-blank",
    slideActiveClass: "swiper-slide-active",
    slideDuplicateActiveClass: "swiper-slide-duplicate-active",
    slideVisibleClass: "swiper-slide-visible",
    slideDuplicateClass: "swiper-slide-duplicate",
    slideNextClass: "swiper-slide-next",
    slideDuplicateNextClass: "swiper-slide-duplicate-next",
    slidePrevClass: "swiper-slide-prev",
    slideDuplicatePrevClass: "swiper-slide-duplicate-prev",
    wrapperClass: "swiper-wrapper",
    runCallbacksOnInit: !0,
    _emitClasses: !1,
  };
function moduleExtendParams(U, N) {
  return function (Q) {
    Q === void 0 && (Q = {});
    const ee = Object.keys(Q)[0],
      te = Q[ee];
    if (typeof te != "object" || te === null) {
      extend(N, Q);
      return;
    }
    if (
      (["navigation", "pagination", "scrollbar"].indexOf(ee) >= 0 &&
        U[ee] === !0 &&
        (U[ee] = { auto: !0 }),
        !(ee in U && "enabled" in te))
    ) {
      extend(N, Q);
      return;
    }
    U[ee] === !0 && (U[ee] = { enabled: !0 }),
      typeof U[ee] == "object" && !("enabled" in U[ee]) && (U[ee].enabled = !0),
      U[ee] || (U[ee] = { enabled: !1 }),
      extend(N, Q);
  };
}
const prototypes = {
  eventsEmitter,
  update,
  translate,
  transition,
  slide,
  loop,
  grabCursor,
  events: events$1,
  breakpoints,
  checkOverflow: checkOverflow$1,
  classes,
  images,
},
  extendedDefaults = {};
class Swiper {
  constructor() {
    let N, K;
    for (var Q = arguments.length, ee = new Array(Q), te = 0; te < Q; te++)
      ee[te] = arguments[te];
    if (
      (ee.length === 1 &&
        ee[0].constructor &&
        Object.prototype.toString.call(ee[0]).slice(8, -1) === "Object"
        ? (K = ee[0])
        : ([N, K] = ee),
        K || (K = {}),
        (K = extend({}, K)),
        N && !K.el && (K.el = N),
        K.el && $(K.el).length > 1)
    ) {
      const re = [];
      return (
        $(K.el).each((ae) => {
          const le = extend({}, K, { el: ae });
          re.push(new Swiper(le));
        }),
        re
      );
    }
    const ie = this;
    (ie.__swiper__ = !0),
      (ie.support = getSupport()),
      (ie.device = getDevice({ userAgent: K.userAgent })),
      (ie.browser = getBrowser()),
      (ie.eventsListeners = {}),
      (ie.eventsAnyListeners = []),
      (ie.modules = [...ie.__modules__]),
      K.modules && Array.isArray(K.modules) && ie.modules.push(...K.modules);
    const ne = {};
    ie.modules.forEach((re) => {
      re({
        swiper: ie,
        extendParams: moduleExtendParams(K, ne),
        on: ie.on.bind(ie),
        once: ie.once.bind(ie),
        off: ie.off.bind(ie),
        emit: ie.emit.bind(ie),
      });
    });
    const se = extend({}, defaults, ne);
    return (
      (ie.params = extend({}, se, extendedDefaults, K)),
      (ie.originalParams = extend({}, ie.params)),
      (ie.passedParams = extend({}, K)),
      ie.params &&
      ie.params.on &&
      Object.keys(ie.params.on).forEach((re) => {
        ie.on(re, ie.params.on[re]);
      }),
      ie.params && ie.params.onAny && ie.onAny(ie.params.onAny),
      (ie.$ = $),
      Object.assign(ie, {
        enabled: ie.params.enabled,
        el: N,
        classNames: [],
        slides: $(),
        slidesGrid: [],
        snapGrid: [],
        slidesSizesGrid: [],
        isHorizontal() {
          return ie.params.direction === "horizontal";
        },
        isVertical() {
          return ie.params.direction === "vertical";
        },
        activeIndex: 0,
        realIndex: 0,
        isBeginning: !0,
        isEnd: !1,
        translate: 0,
        previousTranslate: 0,
        progress: 0,
        velocity: 0,
        animating: !1,
        allowSlideNext: ie.params.allowSlideNext,
        allowSlidePrev: ie.params.allowSlidePrev,
        touchEvents: (function () {
          const ae = ["touchstart", "touchmove", "touchend", "touchcancel"],
            le = ["pointerdown", "pointermove", "pointerup"];
          return (
            (ie.touchEventsTouch = {
              start: ae[0],
              move: ae[1],
              end: ae[2],
              cancel: ae[3],
            }),
            (ie.touchEventsDesktop = { start: le[0], move: le[1], end: le[2] }),
            ie.support.touch || !ie.params.simulateTouch
              ? ie.touchEventsTouch
              : ie.touchEventsDesktop
          );
        })(),
        touchEventsData: {
          isTouched: void 0,
          isMoved: void 0,
          allowTouchCallbacks: void 0,
          touchStartTime: void 0,
          isScrolling: void 0,
          currentTranslate: void 0,
          startTranslate: void 0,
          allowThresholdMove: void 0,
          focusableElements: ie.params.focusableElements,
          lastClickTime: now(),
          clickTimeout: void 0,
          velocities: [],
          allowMomentumBounce: void 0,
          isTouchEvent: void 0,
          startMoving: void 0,
        },
        allowClick: !0,
        allowTouchMove: ie.params.allowTouchMove,
        touches: { startX: 0, startY: 0, currentX: 0, currentY: 0, diff: 0 },
        imagesToLoad: [],
        imagesLoaded: 0,
      }),
      ie.emit("_swiper"),
      ie.params.init && ie.init(),
      ie
    );
  }
  enable() {
    const N = this;
    N.enabled ||
      ((N.enabled = !0),
        N.params.grabCursor && N.setGrabCursor(),
        N.emit("enable"));
  }
  disable() {
    const N = this;
    !N.enabled ||
      ((N.enabled = !1),
        N.params.grabCursor && N.unsetGrabCursor(),
        N.emit("disable"));
  }
  setProgress(N, K) {
    const Q = this;
    N = Math.min(Math.max(N, 0), 1);
    const ee = Q.minTranslate(),
      ie = (Q.maxTranslate() - ee) * N + ee;
    Q.translateTo(ie, typeof K == "undefined" ? 0 : K),
      Q.updateActiveIndex(),
      Q.updateSlidesClasses();
  }
  emitContainerClasses() {
    const N = this;
    if (!N.params._emitClasses || !N.el) return;
    const K = N.el.className
      .split(" ")
      .filter(
        (Q) =>
          Q.indexOf("swiper") === 0 ||
          Q.indexOf(N.params.containerModifierClass) === 0
      );
    N.emit("_containerClasses", K.join(" "));
  }
  getSlideClasses(N) {
    const K = this;
    return K.destroyed
      ? ""
      : N.className
        .split(" ")
        .filter(
          (Q) =>
            Q.indexOf("swiper-slide") === 0 ||
            Q.indexOf(K.params.slideClass) === 0
        )
        .join(" ");
  }
  emitSlidesClasses() {
    const N = this;
    if (!N.params._emitClasses || !N.el) return;
    const K = [];
    N.slides.each((Q) => {
      const ee = N.getSlideClasses(Q);
      K.push({ slideEl: Q, classNames: ee }), N.emit("_slideClass", Q, ee);
    }),
      N.emit("_slideClasses", K);
  }
  slidesPerViewDynamic(N, K) {
    N === void 0 && (N = "current"), K === void 0 && (K = !1);
    const Q = this,
      {
        params: ee,
        slides: te,
        slidesGrid: ie,
        slidesSizesGrid: ne,
        size: se,
        activeIndex: re,
      } = Q;
    let ae = 1;
    if (ee.centeredSlides) {
      let le = te[re].swiperSlideSize,
        de;
      for (let pe = re + 1; pe < te.length; pe += 1)
        te[pe] &&
          !de &&
          ((le += te[pe].swiperSlideSize), (ae += 1), le > se && (de = !0));
      for (let pe = re - 1; pe >= 0; pe -= 1)
        te[pe] &&
          !de &&
          ((le += te[pe].swiperSlideSize), (ae += 1), le > se && (de = !0));
    } else if (N === "current")
      for (let le = re + 1; le < te.length; le += 1)
        (K ? ie[le] + ne[le] - ie[re] < se : ie[le] - ie[re] < se) && (ae += 1);
    else
      for (let le = re - 1; le >= 0; le -= 1) ie[re] - ie[le] < se && (ae += 1);
    return ae;
  }
  update() {
    const N = this;
    if (!N || N.destroyed) return;
    const { snapGrid: K, params: Q } = N;
    Q.breakpoints && N.setBreakpoint(),
      N.updateSize(),
      N.updateSlides(),
      N.updateProgress(),
      N.updateSlidesClasses();
    function ee() {
      const ie = N.rtlTranslate ? N.translate * -1 : N.translate,
        ne = Math.min(Math.max(ie, N.maxTranslate()), N.minTranslate());
      N.setTranslate(ne), N.updateActiveIndex(), N.updateSlidesClasses();
    }
    let te;
    N.params.freeMode && N.params.freeMode.enabled
      ? (ee(), N.params.autoHeight && N.updateAutoHeight())
      : ((N.params.slidesPerView === "auto" || N.params.slidesPerView > 1) &&
        N.isEnd &&
        !N.params.centeredSlides
        ? (te = N.slideTo(N.slides.length - 1, 0, !1, !0))
        : (te = N.slideTo(N.activeIndex, 0, !1, !0)),
        te || ee()),
      Q.watchOverflow && K !== N.snapGrid && N.checkOverflow(),
      N.emit("update");
  }
  changeDirection(N, K) {
    K === void 0 && (K = !0);
    const Q = this,
      ee = Q.params.direction;
    return (
      N || (N = ee === "horizontal" ? "vertical" : "horizontal"),
      N === ee ||
      (N !== "horizontal" && N !== "vertical") ||
      (Q.$el
        .removeClass(`${Q.params.containerModifierClass}${ee}`)
        .addClass(`${Q.params.containerModifierClass}${N}`),
        Q.emitContainerClasses(),
        (Q.params.direction = N),
        Q.slides.each((te) => {
          N === "vertical" ? (te.style.width = "") : (te.style.height = "");
        }),
        Q.emit("changeDirection"),
        K && Q.update()),
      Q
    );
  }
  mount(N) {
    const K = this;
    if (K.mounted) return !0;
    const Q = $(N || K.params.el);
    if (((N = Q[0]), !N)) return !1;
    N.swiper = K;
    const ee = () =>
      `.${(K.params.wrapperClass || "").trim().split(" ").join(".")}`;
    let ie = (() => {
      if (N && N.shadowRoot && N.shadowRoot.querySelector) {
        const ne = $(N.shadowRoot.querySelector(ee()));
        return (ne.children = (se) => Q.children(se)), ne;
      }
      return Q.children ? Q.children(ee()) : $(Q).children(ee());
    })();
    if (ie.length === 0 && K.params.createElements) {
      const se = getDocument().createElement("div");
      (ie = $(se)),
        (se.className = K.params.wrapperClass),
        Q.append(se),
        Q.children(`.${K.params.slideClass}`).each((re) => {
          ie.append(re);
        });
    }
    return (
      Object.assign(K, {
        $el: Q,
        el: N,
        $wrapperEl: ie,
        wrapperEl: ie[0],
        mounted: !0,
        rtl: N.dir.toLowerCase() === "rtl" || Q.css("direction") === "rtl",
        rtlTranslate:
          K.params.direction === "horizontal" &&
          (N.dir.toLowerCase() === "rtl" || Q.css("direction") === "rtl"),
        wrongRTL: ie.css("display") === "-webkit-box",
      }),
      !0
    );
  }
  init(N) {
    const K = this;
    return (
      K.initialized ||
      K.mount(N) === !1 ||
      (K.emit("beforeInit"),
        K.params.breakpoints && K.setBreakpoint(),
        K.addClasses(),
        K.params.loop && K.loopCreate(),
        K.updateSize(),
        K.updateSlides(),
        K.params.watchOverflow && K.checkOverflow(),
        K.params.grabCursor && K.enabled && K.setGrabCursor(),
        K.params.preloadImages && K.preloadImages(),
        K.params.loop
          ? K.slideTo(
            K.params.initialSlide + K.loopedSlides,
            0,
            K.params.runCallbacksOnInit,
            !1,
            !0
          )
          : K.slideTo(
            K.params.initialSlide,
            0,
            K.params.runCallbacksOnInit,
            !1,
            !0
          ),
        K.attachEvents(),
        (K.initialized = !0),
        K.emit("init"),
        K.emit("afterInit")),
      K
    );
  }
  destroy(N, K) {
    N === void 0 && (N = !0), K === void 0 && (K = !0);
    const Q = this,
      { params: ee, $el: te, $wrapperEl: ie, slides: ne } = Q;
    return (
      typeof Q.params == "undefined" ||
      Q.destroyed ||
      (Q.emit("beforeDestroy"),
        (Q.initialized = !1),
        Q.detachEvents(),
        ee.loop && Q.loopDestroy(),
        K &&
        (Q.removeClasses(),
          te.removeAttr("style"),
          ie.removeAttr("style"),
          ne &&
          ne.length &&
          ne
            .removeClass(
              [
                ee.slideVisibleClass,
                ee.slideActiveClass,
                ee.slideNextClass,
                ee.slidePrevClass,
              ].join(" ")
            )
            .removeAttr("style")
            .removeAttr("data-swiper-slide-index")),
        Q.emit("destroy"),
        Object.keys(Q.eventsListeners).forEach((se) => {
          Q.off(se);
        }),
        N !== !1 && ((Q.$el[0].swiper = null), deleteProps(Q)),
        (Q.destroyed = !0)),
      null
    );
  }
  static extendDefaults(N) {
    extend(extendedDefaults, N);
  }
  static get extendedDefaults() {
    return extendedDefaults;
  }
  static get defaults() {
    return defaults;
  }
  static installModule(N) {
    Swiper.prototype.__modules__ || (Swiper.prototype.__modules__ = []);
    const K = Swiper.prototype.__modules__;
    typeof N == "function" && K.indexOf(N) < 0 && K.push(N);
  }
  static use(N) {
    return Array.isArray(N)
      ? (N.forEach((K) => Swiper.installModule(K)), Swiper)
      : (Swiper.installModule(N), Swiper);
  }
}
Object.keys(prototypes).forEach((U) => {
  Object.keys(prototypes[U]).forEach((N) => {
    Swiper.prototype[N] = prototypes[U][N];
  });
});
Swiper.use([Resize, Observer]);
function createElementIfNotDefined(U, N, K, Q) {
  const ee = getDocument();
  return (
    U.params.createElements &&
    Object.keys(Q).forEach((te) => {
      if (!K[te] && K.auto === !0) {
        let ie = U.$el.children(`.${Q[te]}`)[0];
        ie ||
          ((ie = ee.createElement("div")),
            (ie.className = Q[te]),
            U.$el.append(ie)),
          (K[te] = ie),
          (N[te] = ie);
      }
    }),
    K
  );
}
function Navigation(U) {
  let { swiper: N, extendParams: K, on: Q, emit: ee } = U;
  K({
    navigation: {
      nextEl: null,
      prevEl: null,
      hideOnClick: !1,
      disabledClass: "swiper-button-disabled",
      hiddenClass: "swiper-button-hidden",
      lockClass: "swiper-button-lock",
      navigationDisabledClass: "swiper-navigation-disabled",
    },
  }),
    (N.navigation = {
      nextEl: null,
      $nextEl: null,
      prevEl: null,
      $prevEl: null,
    });
  function te(ue) {
    let fe;
    return (
      ue &&
      ((fe = $(ue)),
        N.params.uniqueNavElements &&
        typeof ue == "string" &&
        fe.length > 1 &&
        N.$el.find(ue).length === 1 &&
        (fe = N.$el.find(ue))),
      fe
    );
  }
  function ie(ue, fe) {
    const oe = N.params.navigation;
    ue &&
      ue.length > 0 &&
      (ue[fe ? "addClass" : "removeClass"](oe.disabledClass),
        ue[0] && ue[0].tagName === "BUTTON" && (ue[0].disabled = fe),
        N.params.watchOverflow &&
        N.enabled &&
        ue[N.isLocked ? "addClass" : "removeClass"](oe.lockClass));
  }
  function ne() {
    if (N.params.loop) return;
    const { $nextEl: ue, $prevEl: fe } = N.navigation;
    ie(fe, N.isBeginning && !N.params.rewind),
      ie(ue, N.isEnd && !N.params.rewind);
  }
  function se(ue) {
    ue.preventDefault(),
      !(N.isBeginning && !N.params.loop && !N.params.rewind) && N.slidePrev();
  }
  function re(ue) {
    ue.preventDefault(),
      !(N.isEnd && !N.params.loop && !N.params.rewind) && N.slideNext();
  }
  function ae() {
    const ue = N.params.navigation;
    if (
      ((N.params.navigation = createElementIfNotDefined(
        N,
        N.originalParams.navigation,
        N.params.navigation,
        { nextEl: "swiper-button-next", prevEl: "swiper-button-prev" }
      )),
        !(ue.nextEl || ue.prevEl))
    )
      return;
    const fe = te(ue.nextEl),
      oe = te(ue.prevEl);
    fe && fe.length > 0 && fe.on("click", re),
      oe && oe.length > 0 && oe.on("click", se),
      Object.assign(N.navigation, {
        $nextEl: fe,
        nextEl: fe && fe[0],
        $prevEl: oe,
        prevEl: oe && oe[0],
      }),
      N.enabled ||
      (fe && fe.addClass(ue.lockClass), oe && oe.addClass(ue.lockClass));
  }
  function le() {
    const { $nextEl: ue, $prevEl: fe } = N.navigation;
    ue &&
      ue.length &&
      (ue.off("click", re), ue.removeClass(N.params.navigation.disabledClass)),
      fe &&
      fe.length &&
      (fe.off("click", se),
        fe.removeClass(N.params.navigation.disabledClass));
  }
  Q("init", () => {
    N.params.navigation.enabled === !1 ? pe() : (ae(), ne());
  }),
    Q("toEdge fromEdge lock unlock", () => {
      ne();
    }),
    Q("destroy", () => {
      le();
    }),
    Q("enable disable", () => {
      const { $nextEl: ue, $prevEl: fe } = N.navigation;
      ue &&
        ue[N.enabled ? "removeClass" : "addClass"](
          N.params.navigation.lockClass
        ),
        fe &&
        fe[N.enabled ? "removeClass" : "addClass"](
          N.params.navigation.lockClass
        );
    }),
    Q("click", (ue, fe) => {
      const { $nextEl: oe, $prevEl: ce } = N.navigation,
        he = fe.target;
      if (N.params.navigation.hideOnClick && !$(he).is(ce) && !$(he).is(oe)) {
        if (
          N.pagination &&
          N.params.pagination &&
          N.params.pagination.clickable &&
          (N.pagination.el === he || N.pagination.el.contains(he))
        )
          return;
        let me;
        oe
          ? (me = oe.hasClass(N.params.navigation.hiddenClass))
          : ce && (me = ce.hasClass(N.params.navigation.hiddenClass)),
          ee(me === !0 ? "navigationShow" : "navigationHide"),
          oe && oe.toggleClass(N.params.navigation.hiddenClass),
          ce && ce.toggleClass(N.params.navigation.hiddenClass);
      }
    });
  const de = () => {
    N.$el.removeClass(N.params.navigation.navigationDisabledClass),
      ae(),
      ne();
  },
    pe = () => {
      N.$el.addClass(N.params.navigation.navigationDisabledClass), le();
    };
  Object.assign(N.navigation, {
    enable: de,
    disable: pe,
    update: ne,
    init: ae,
    destroy: le,
  });
}
function classesToSelector(U) {
  return (
    U === void 0 && (U = ""),
    `.${U.trim()
      .replace(/([\.:!\/])/g, "\\$1")
      .replace(/ /g, ".")}`
  );
}
function Pagination(U) {
  let { swiper: N, extendParams: K, on: Q, emit: ee } = U;
  const te = "swiper-pagination";
  K({
    pagination: {
      el: null,
      bulletElement: "span",
      clickable: !1,
      hideOnClick: !1,
      renderBullet: null,
      renderProgressbar: null,
      renderFraction: null,
      renderCustom: null,
      progressbarOpposite: !1,
      type: "bullets",
      dynamicBullets: !1,
      dynamicMainBullets: 1,
      formatFractionCurrent: (oe) => oe,
      formatFractionTotal: (oe) => oe,
      bulletClass: `${te}-bullet`,
      bulletActiveClass: `${te}-bullet-active`,
      modifierClass: `${te}-`,
      currentClass: `${te}-current`,
      totalClass: `${te}-total`,
      hiddenClass: `${te}-hidden`,
      progressbarFillClass: `${te}-progressbar-fill`,
      progressbarOppositeClass: `${te}-progressbar-opposite`,
      clickableClass: `${te}-clickable`,
      lockClass: `${te}-lock`,
      horizontalClass: `${te}-horizontal`,
      verticalClass: `${te}-vertical`,
      paginationDisabledClass: `${te}-disabled`,
    },
  }),
    (N.pagination = { el: null, $el: null, bullets: [] });
  let ie,
    ne = 0;
  function se() {
    return (
      !N.params.pagination.el ||
      !N.pagination.el ||
      !N.pagination.$el ||
      N.pagination.$el.length === 0
    );
  }
  function re(oe, ce) {
    const { bulletActiveClass: he } = N.params.pagination;
    oe[ce]().addClass(`${he}-${ce}`)[ce]().addClass(`${he}-${ce}-${ce}`);
  }
  function ae() {
    const oe = N.rtl,
      ce = N.params.pagination;
    if (se()) return;
    const he =
      N.virtual && N.params.virtual.enabled
        ? N.virtual.slides.length
        : N.slides.length,
      me = N.pagination.$el;
    let ge;
    const Se = N.params.loop
      ? Math.ceil((he - N.loopedSlides * 2) / N.params.slidesPerGroup)
      : N.snapGrid.length;
    if (
      (N.params.loop
        ? ((ge = Math.ceil(
          (N.activeIndex - N.loopedSlides) / N.params.slidesPerGroup
        )),
          ge > he - 1 - N.loopedSlides * 2 && (ge -= he - N.loopedSlides * 2),
          ge > Se - 1 && (ge -= Se),
          ge < 0 && N.params.paginationType !== "bullets" && (ge = Se + ge))
        : typeof N.snapIndex != "undefined"
          ? (ge = N.snapIndex)
          : (ge = N.activeIndex || 0),
        ce.type === "bullets" &&
        N.pagination.bullets &&
        N.pagination.bullets.length > 0)
    ) {
      const be = N.pagination.bullets;
      let Te, ye, Ce;
      if (
        (ce.dynamicBullets &&
          ((ie = be.eq(0)[N.isHorizontal() ? "outerWidth" : "outerHeight"](!0)),
            me.css(
              N.isHorizontal() ? "width" : "height",
              `${ie * (ce.dynamicMainBullets + 4)}px`
            ),
            ce.dynamicMainBullets > 1 &&
            N.previousIndex !== void 0 &&
            ((ne += ge - (N.previousIndex - N.loopedSlides || 0)),
              ne > ce.dynamicMainBullets - 1
                ? (ne = ce.dynamicMainBullets - 1)
                : ne < 0 && (ne = 0)),
            (Te = Math.max(ge - ne, 0)),
            (ye = Te + (Math.min(be.length, ce.dynamicMainBullets) - 1)),
            (Ce = (ye + Te) / 2)),
          be.removeClass(
            ["", "-next", "-next-next", "-prev", "-prev-prev", "-main"]
              .map(($e) => `${ce.bulletActiveClass}${$e}`)
              .join(" ")
          ),
          me.length > 1)
      )
        be.each(($e) => {
          const ve = $($e),
            we = ve.index();
          we === ge && ve.addClass(ce.bulletActiveClass),
            ce.dynamicBullets &&
            (we >= Te &&
              we <= ye &&
              ve.addClass(`${ce.bulletActiveClass}-main`),
              we === Te && re(ve, "prev"),
              we === ye && re(ve, "next"));
        });
      else {
        const $e = be.eq(ge),
          ve = $e.index();
        if (($e.addClass(ce.bulletActiveClass), ce.dynamicBullets)) {
          const we = be.eq(Te),
            xe = be.eq(ye);
          for (let Ee = Te; Ee <= ye; Ee += 1)
            be.eq(Ee).addClass(`${ce.bulletActiveClass}-main`);
          if (N.params.loop)
            if (ve >= be.length) {
              for (let Ee = ce.dynamicMainBullets; Ee >= 0; Ee -= 1)
                be.eq(be.length - Ee).addClass(`${ce.bulletActiveClass}-main`);
              be.eq(be.length - ce.dynamicMainBullets - 1).addClass(
                `${ce.bulletActiveClass}-prev`
              );
            } else re(we, "prev"), re(xe, "next");
          else re(we, "prev"), re(xe, "next");
        }
      }
      if (ce.dynamicBullets) {
        const $e = Math.min(be.length, ce.dynamicMainBullets + 4),
          ve = (ie * $e - ie) / 2 - Ce * ie,
          we = oe ? "right" : "left";
        be.css(N.isHorizontal() ? we : "top", `${ve}px`);
      }
    }
    if (
      (ce.type === "fraction" &&
        (me
          .find(classesToSelector(ce.currentClass))
          .text(ce.formatFractionCurrent(ge + 1)),
          me
            .find(classesToSelector(ce.totalClass))
            .text(ce.formatFractionTotal(Se))),
        ce.type === "progressbar")
    ) {
      let be;
      ce.progressbarOpposite
        ? (be = N.isHorizontal() ? "vertical" : "horizontal")
        : (be = N.isHorizontal() ? "horizontal" : "vertical");
      const Te = (ge + 1) / Se;
      let ye = 1,
        Ce = 1;
      be === "horizontal" ? (ye = Te) : (Ce = Te),
        me
          .find(classesToSelector(ce.progressbarFillClass))
          .transform(`translate3d(0,0,0) scaleX(${ye}) scaleY(${Ce})`)
          .transition(N.params.speed);
    }
    ce.type === "custom" && ce.renderCustom
      ? (me.html(ce.renderCustom(N, ge + 1, Se)), ee("paginationRender", me[0]))
      : ee("paginationUpdate", me[0]),
      N.params.watchOverflow &&
      N.enabled &&
      me[N.isLocked ? "addClass" : "removeClass"](ce.lockClass);
  }
  function le() {
    const oe = N.params.pagination;
    if (se()) return;
    const ce =
      N.virtual && N.params.virtual.enabled
        ? N.virtual.slides.length
        : N.slides.length,
      he = N.pagination.$el;
    let me = "";
    if (oe.type === "bullets") {
      let ge = N.params.loop
        ? Math.ceil((ce - N.loopedSlides * 2) / N.params.slidesPerGroup)
        : N.snapGrid.length;
      N.params.freeMode &&
        N.params.freeMode.enabled &&
        !N.params.loop &&
        ge > ce &&
        (ge = ce);
      for (let Se = 0; Se < ge; Se += 1)
        oe.renderBullet
          ? (me += oe.renderBullet.call(N, Se, oe.bulletClass))
          : (me += `<${oe.bulletElement} class="${oe.bulletClass}"></${oe.bulletElement}>`);
      he.html(me),
        (N.pagination.bullets = he.find(classesToSelector(oe.bulletClass)));
    }
    oe.type === "fraction" &&
      (oe.renderFraction
        ? (me = oe.renderFraction.call(N, oe.currentClass, oe.totalClass))
        : (me = `<span class="${oe.currentClass}"></span> / <span class="${oe.totalClass}"></span>`),
        he.html(me)),
      oe.type === "progressbar" &&
      (oe.renderProgressbar
        ? (me = oe.renderProgressbar.call(N, oe.progressbarFillClass))
        : (me = `<span class="${oe.progressbarFillClass}"></span>`),
        he.html(me)),
      oe.type !== "custom" && ee("paginationRender", N.pagination.$el[0]);
  }
  function de() {
    N.params.pagination = createElementIfNotDefined(
      N,
      N.originalParams.pagination,
      N.params.pagination,
      { el: "swiper-pagination" }
    );
    const oe = N.params.pagination;
    if (!oe.el) return;
    let ce = $(oe.el);
    ce.length !== 0 &&
      (N.params.uniqueNavElements &&
        typeof oe.el == "string" &&
        ce.length > 1 &&
        ((ce = N.$el.find(oe.el)),
          ce.length > 1 &&
          (ce = ce.filter((he) => $(he).parents(".swiper")[0] === N.el))),
        oe.type === "bullets" && oe.clickable && ce.addClass(oe.clickableClass),
        ce.addClass(oe.modifierClass + oe.type),
        ce.addClass(N.isHorizontal() ? oe.horizontalClass : oe.verticalClass),
        oe.type === "bullets" &&
        oe.dynamicBullets &&
        (ce.addClass(`${oe.modifierClass}${oe.type}-dynamic`),
          (ne = 0),
          oe.dynamicMainBullets < 1 && (oe.dynamicMainBullets = 1)),
        oe.type === "progressbar" &&
        oe.progressbarOpposite &&
        ce.addClass(oe.progressbarOppositeClass),
        oe.clickable &&
        ce.on("click", classesToSelector(oe.bulletClass), function (me) {
          me.preventDefault();
          let ge = $(this).index() * N.params.slidesPerGroup;
          N.params.loop && (ge += N.loopedSlides), N.slideTo(ge);
        }),
        Object.assign(N.pagination, { $el: ce, el: ce[0] }),
        N.enabled || ce.addClass(oe.lockClass));
  }
  function pe() {
    const oe = N.params.pagination;
    if (se()) return;
    const ce = N.pagination.$el;
    ce.removeClass(oe.hiddenClass),
      ce.removeClass(oe.modifierClass + oe.type),
      ce.removeClass(N.isHorizontal() ? oe.horizontalClass : oe.verticalClass),
      N.pagination.bullets &&
      N.pagination.bullets.removeClass &&
      N.pagination.bullets.removeClass(oe.bulletActiveClass),
      oe.clickable && ce.off("click", classesToSelector(oe.bulletClass));
  }
  Q("init", () => {
    N.params.pagination.enabled === !1 ? fe() : (de(), le(), ae());
  }),
    Q("activeIndexChange", () => {
      (N.params.loop || typeof N.snapIndex == "undefined") && ae();
    }),
    Q("snapIndexChange", () => {
      N.params.loop || ae();
    }),
    Q("slidesLengthChange", () => {
      N.params.loop && (le(), ae());
    }),
    Q("snapGridLengthChange", () => {
      N.params.loop || (le(), ae());
    }),
    Q("destroy", () => {
      pe();
    }),
    Q("enable disable", () => {
      const { $el: oe } = N.pagination;
      oe &&
        oe[N.enabled ? "removeClass" : "addClass"](
          N.params.pagination.lockClass
        );
    }),
    Q("lock unlock", () => {
      ae();
    }),
    Q("click", (oe, ce) => {
      const he = ce.target,
        { $el: me } = N.pagination;
      if (
        N.params.pagination.el &&
        N.params.pagination.hideOnClick &&
        me.length > 0 &&
        !$(he).hasClass(N.params.pagination.bulletClass)
      ) {
        if (
          N.navigation &&
          ((N.navigation.nextEl && he === N.navigation.nextEl) ||
            (N.navigation.prevEl && he === N.navigation.prevEl))
        )
          return;
        const ge = me.hasClass(N.params.pagination.hiddenClass);
        ee(ge === !0 ? "paginationShow" : "paginationHide"),
          me.toggleClass(N.params.pagination.hiddenClass);
      }
    });
  const ue = () => {
    N.$el.removeClass(N.params.pagination.paginationDisabledClass),
      N.pagination.$el &&
      N.pagination.$el.removeClass(
        N.params.pagination.paginationDisabledClass
      ),
      de(),
      le(),
      ae();
  },
    fe = () => {
      N.$el.addClass(N.params.pagination.paginationDisabledClass),
        N.pagination.$el &&
        N.pagination.$el.addClass(
          N.params.pagination.paginationDisabledClass
        ),
        pe();
    };
  Object.assign(N.pagination, {
    enable: ue,
    disable: fe,
    render: le,
    update: ae,
    init: de,
    destroy: pe,
  });
}
function Autoplay(U) {
  let { swiper: N, extendParams: K, on: Q, emit: ee } = U,
    te;
  (N.autoplay = { running: !1, paused: !1 }),
    K({
      autoplay: {
        enabled: !1,
        delay: 3e3,
        waitForTransition: !0,
        disableOnInteraction: !0,
        stopOnLastSlide: !1,
        reverseDirection: !1,
        pauseOnMouseEnter: !1,
      },
    });
  function ie() {
    const oe = N.slides.eq(N.activeIndex);
    let ce = N.params.autoplay.delay;
    oe.attr("data-swiper-autoplay") &&
      (ce = oe.attr("data-swiper-autoplay") || N.params.autoplay.delay),
      clearTimeout(te),
      (te = nextTick(() => {
        let he;
        N.params.autoplay.reverseDirection
          ? N.params.loop
            ? (N.loopFix(),
              (he = N.slidePrev(N.params.speed, !0, !0)),
              ee("autoplay"))
            : N.isBeginning
              ? N.params.autoplay.stopOnLastSlide
                ? se()
                : ((he = N.slideTo(N.slides.length - 1, N.params.speed, !0, !0)),
                  ee("autoplay"))
              : ((he = N.slidePrev(N.params.speed, !0, !0)), ee("autoplay"))
          : N.params.loop
            ? (N.loopFix(),
              (he = N.slideNext(N.params.speed, !0, !0)),
              ee("autoplay"))
            : N.isEnd
              ? N.params.autoplay.stopOnLastSlide
                ? se()
                : ((he = N.slideTo(0, N.params.speed, !0, !0)), ee("autoplay"))
              : ((he = N.slideNext(N.params.speed, !0, !0)), ee("autoplay")),
          ((N.params.cssMode && N.autoplay.running) || he === !1) && ie();
      }, ce));
  }
  function ne() {
    return typeof te != "undefined" || N.autoplay.running
      ? !1
      : ((N.autoplay.running = !0), ee("autoplayStart"), ie(), !0);
  }
  function se() {
    return !N.autoplay.running || typeof te == "undefined"
      ? !1
      : (te && (clearTimeout(te), (te = void 0)),
        (N.autoplay.running = !1),
        ee("autoplayStop"),
        !0);
  }
  function re(oe) {
    !N.autoplay.running ||
      N.autoplay.paused ||
      (te && clearTimeout(te),
        (N.autoplay.paused = !0),
        oe === 0 || !N.params.autoplay.waitForTransition
          ? ((N.autoplay.paused = !1), ie())
          : ["transitionend", "webkitTransitionEnd"].forEach((ce) => {
            N.$wrapperEl[0].addEventListener(ce, le);
          }));
  }
  function ae() {
    const oe = getDocument();
    oe.visibilityState === "hidden" && N.autoplay.running && re(),
      oe.visibilityState === "visible" &&
      N.autoplay.paused &&
      (ie(), (N.autoplay.paused = !1));
  }
  function le(oe) {
    !N ||
      N.destroyed ||
      !N.$wrapperEl ||
      (oe.target === N.$wrapperEl[0] &&
        (["transitionend", "webkitTransitionEnd"].forEach((ce) => {
          N.$wrapperEl[0].removeEventListener(ce, le);
        }),
          (N.autoplay.paused = !1),
          N.autoplay.running ? ie() : se()));
  }
  function de() {
    N.params.autoplay.disableOnInteraction ? se() : (ee("autoplayPause"), re()),
      ["transitionend", "webkitTransitionEnd"].forEach((oe) => {
        N.$wrapperEl[0].removeEventListener(oe, le);
      });
  }
  function pe() {
    N.params.autoplay.disableOnInteraction ||
      ((N.autoplay.paused = !1), ee("autoplayResume"), ie());
  }
  function ue() {
    N.params.autoplay.pauseOnMouseEnter &&
      (N.$el.on("mouseenter", de), N.$el.on("mouseleave", pe));
  }
  function fe() {
    N.$el.off("mouseenter", de), N.$el.off("mouseleave", pe);
  }
  Q("init", () => {
    N.params.autoplay.enabled &&
      (ne(), getDocument().addEventListener("visibilitychange", ae), ue());
  }),
    Q("beforeTransitionStart", (oe, ce, he) => {
      N.autoplay.running &&
        (he || !N.params.autoplay.disableOnInteraction
          ? N.autoplay.pause(ce)
          : se());
    }),
    Q("sliderFirstMove", () => {
      N.autoplay.running &&
        (N.params.autoplay.disableOnInteraction ? se() : re());
    }),
    Q("touchEnd", () => {
      N.params.cssMode &&
        N.autoplay.paused &&
        !N.params.autoplay.disableOnInteraction &&
        ie();
    }),
    Q("destroy", () => {
      fe(),
        N.autoplay.running && se(),
        getDocument().removeEventListener("visibilitychange", ae);
    }),
    Object.assign(N.autoplay, { pause: re, run: ie, start: ne, stop: se });
}
Swiper.use([Autoplay, Pagination]),
  y$3(() => {
    E$2(".slider").forEach((U) => {
      new Swiper(U, {
        autoplay: { delay: 4e3, disableOnInteraction: !1 },
        pagination: { el: ".swiper-pagination", clickable: !0 },
      });
    });
  });
Swiper.use([Autoplay, Pagination]),
  y$3(() => {
    E$2(".slider-tab").forEach((U) => {
      const N = E$2("ul.tabs li", U),
        K = (ee) => {
          N.forEach((te) => {
            x$2(te, z + 0), g$3(te, z + 100);
          }),
            x$2(N[ee], z + 100),
            g$3(N[ee], z + 0);
        },
        Q = new Swiper(U, {
          on: {
            slideChange(ee) {
              K(ee.activeIndex);
            },
          },
        });
      N.forEach((ee, te) => {
        c$1(ee, "click", () => {
          Q.slideTo(te), K(te);
        });
      });
    });
  });
const u$1 = E$2("ul.faq");
u$1.forEach((U) => {
  Array.from(U.children).forEach((N, K) => {
    const Q = N.children[0],
      ee = N.children[1],
      te = p$3("svg", Q);
    let ie = !0,
      ne = !1;
    const se = () => {
      (ne = !0),
        (ee.style.height = ee.children[0].clientHeight + "px"),
        ie
          ? (setTimeout(() => {
            (ee.style.height = "auto"), (ne = !1);
          }, 600),
            x$2(te, m$1))
          : (setTimeout(() => {
            (ee.style.height = "0"), (ne = !1);
          }, 50),
            g$3(te, m$1));
    };
    L$2(Q, () => {
      ne || ((ie = !ie), se());
    }),
      K > 0 && (ie = !1),
      se();
  });
});
Swiper.use([Autoplay, Navigation]),
  y$3(() => {
    const U = E$2(".course-list");
    let N = !1;
    U.forEach((K) => {
      const Q = p$3(".swiper", K),
        ee = p$3(".btn-prev", K),
        te = p$3(".btn-next", K);
      if (Q === null) return;
      const ie = new Swiper(Q, {
        slidesPerView: "auto",
        freeMode: !0,
        direction: "horizontal",
        spaceBetween: 0,
        navigation: {
          nextEl: te,
          prevEl: ee,
          disabledClass: E$3 + " pointer-events-none",
        },
        autoplay: { delay: 6e3, disableOnInteraction: !0 },
      }),
        ne = E$2(".swiper-slide", K);
      setTimeout(() => {
        ne.forEach((ae) => {
          x$2(ae, d$3);
        });
      }, 500);
      let se;
      const re = E$2("ul.topics li button", K);
      re.forEach((ae) => {
        L$2(ae, () => {
          if (N) return;
          (N = !0),
            (se = ae.dataset.slug),
            re.forEach((de) => {
              x$2(de, b$1, j$1, hth$1, x$3),
                g$3(de, u$3, bb$1, tw$1, hbw$1, htb$1);
            }),
            x$2(ae, u$3, bb$1, tw$1, hbw$1, htb$1);
          const le = (de) => {
            (de.style.visibility = R$2),
              setTimeout(() => {
                g$3(de, a$3);
              }, 100);
          };
          se === void 0
            ? ne.forEach((de) => le(de))
            : ne.forEach((de) => {
              de.dataset.filter === se
                ? le(de)
                : (x$2(de, a$3),
                  setTimeout(() => {
                    de.style.visibility = v$2;
                  }, 600));
            }),
            ie.slideTo(0),
            setTimeout(() => {
              ie.update(), ie.slideTo(0), (N = !1);
            }, 900),
            m(ae.dataset.slug);
        });
      });
    });
  });
const l = "courses",
  L = u$2(l + "_list_content"),
  w = u$2(l + "-loading");
let f = 1;
const t = {};
let g = new URLSearchParams();
const P = () => {
  window.history.pushState(
    "page" + f,
    document.title,
    "/" +
    l +
    "/page/" +
    f +
    (Object.keys(t).length > 0 ? "?" + g.toString() : "")
  );
},
  p = () => {
    g = new URLSearchParams();
    for (let U in t) g.append(U, encodeURI(t[U].join("-")));
    P();
  },
  k = (U = f) => {
    const N = {};
    for (let K in t) N[K] = encodeURI(t[K].join("-"));
    return (
      d$1(!0, w),
      g$2.coursesLoadPage(De({ page: U }, N)).then((K) => {
        (L.innerHTML = K),
          jQuery("#primary .actions .number-of-posts").replaceWith(
            jQuery(L).find(".number-of-posts").removeClass("hidden")
          ),
          (f = U),
          P(),
          a$2(200),
          setTimeout(() => {
            y$1(), E().then();
          }, 100);
      })
    );
  },
  y$1 = () => {
    const U = u$2(l + "_pagination");
    d$1(!1, w),
      U !== null &&
      E$2("a", U).forEach((N) => {
        const K = N.href.match(/page\/(\d)/)[1];
        L$2(N, (Q) => {
          Q.preventDefault(), k(K).then();
        });
      });
  },
  O = () => {
    const U = E$2("ul." + l + "-filter");
    if (U.length < 1) return;
    const N = window.coursesInitFilterState;
    if (N !== void 0) for (let K in N) t[K] = N[K];
    U.forEach((K) => {
      const Q = E$2("input", K),
        ee = String(K.dataset.name),
        te = (se, re) => {
          if (se == "search" && t.hasOwnProperty(se)) {
            t[se] = [];
          }
          t.hasOwnProperty(se) || (t[se] = []), t[se].push(re), p();
        },
        ie = (se, re) => {
          t.hasOwnProperty(se) || (t[se] = []);
          const ae = t[se].findIndex((le) => le === re);
          ae !== -1 && t[se].splice(ae, 1), p();
        },
        ne = (se) => {
          (t[se] = []), p();
        };
      Q.forEach((se, re) => {
        c$1(se, "change", () => {
          if (se.getAttribute("type") == "text") te(ee, se.value);
          else if (re === 0)
            se.checked
              ? (Array.from(Q)
                .slice(1)
                .forEach((ae) => (ae.checked = !1)),
                ne(ee))
              : (Q[0].checked = !0);
          else if (se.checked) (Q[0].checked = !1), te(ee, se.value);
          else {
            let ae = !1;
            Array.from(Q)
              .slice(1)
              .forEach((le) => {
                le.checked && (ae = !0);
              }),
              ae || (Q[0].checked = !0),
              ie(ee, se.value);
          }
          k(1).then();
        });
      });
    });
  };
y$3(() => {
  L !== void 0 && (y$1(), O());
});
Swiper.use([Autoplay, Navigation]),
  y$3(() => {
    E$2(".ravin-companies").forEach((U) => {
      const N = p$3(".swiper", U),
        K = p$3(".btn-prev", U),
        Q = p$3(".btn-next", U);
      N !== null &&
        new Swiper(N, {
          spaceBetween: 30,
          loop: !0,
          slidesPerView: 6,
          freeMode: !0,
          direction: "horizontal",
          navigation: {
            nextEl: Q,
            prevEl: K,
            disabledClass: E$3 + " pointer-events-none",
          },
          autoplay: { delay: 6e3, disableOnInteraction: !0 },
          breakpoints: {
            0: { slidesPerView: 2, spaceBetween: 15 },
            320: { slidesPerView: 2, spaceBetween: 20 },
            480: { slidesPerView: 3, spaceBetween: 20 },
            768: { slidesPerView: 6, spaceBetween: 20 },
            992: { slidesPerView: 6, spaceBetween: 25 },
          },
        });
    });
  });
const y = (U) => {
  d$1(!0);
  const N = new FormData(U),
    K = F("certificate-modal"),
    Q = E$2(".sticker > div", K),
    ee = p$3(".content", K);
  return (
    g$2
      .checkCertificate({ code: String(N.get("cert_code")) })
      .then((te) => {
        Q[1].style.display = "none";
        const ie = E$2("p strong", ee);
        (ie[0].textContent = te.name),
          (ie[1].textContent = te.course),
          (ie[2].textContent = te.date);
      })
      .catch((te) => {
        (ee.style.display = "none"),
          (Q[0].style.display = "none"),
          m("this is err: "),
          m(te);
      })
      .finally(() => {
        d$1(!1),
          T$2(
            K,
            "\u0627\u0639\u062A\u0628\u0627\u0631\u0633\u0646\u062C\u06CC \u06AF\u0648\u0627\u0647\u06CC\u0646\u0627\u0645\u0647"
          );
      }),
    !1
  );
};
window.checkCertificate = (U) => y(U);
const v = p$3(".single-post"),
  d = "clone-content-table",
  x = () => {
    const U = p$3(".content-table");
    if (U === null) return;
    const N = p$3(`.${d}-box`),
      K = U.cloneNode(!0);
    x$2(K, E$3, d, x$3), N == null || N.append(K);
  },
  A = () => {
    const U = p$3(".post-content"),
      N = p$3(".progress-bar"),
      K = p$3("div", N),
      Q = p$3(`.${d}`),
      ee = E$2("a", Q),
      te = () => {
        let ie = "";
        ee.forEach((ae) => {
          const le = u$2(D(ae.href));
          if (le === null) return;
          const de = le.offsetTop;
          de !== void 0 && window.scrollY >= de - 60 && (ie = le.id);
        }),
          ee.forEach((ae) => {
            g$3(ae, e$2), D(ae.href) === ie && x$2(ae, e$2);
          });
        const ne = window.scrollY - U.offsetTop;
        if (ne < 0) {
          x$2(N, E$3), g$3(N, F$1), Q !== null && (x$2(Q, E$3), g$3(Q, F$1));
          return;
        } else
          x$2(N, F$1), g$3(N, E$3), Q !== null && (x$2(Q, F$1), g$3(Q, E$3));
        const se = U.clientHeight - U.offsetTop,
          re = (ne / se) * 100;
        K.style.width = re.toFixed(3) + "%";
      };
    te(), window.addEventListener("scroll", te);
  };
y$3(() => {
  v !== null && (x(), setTimeout(A, 300));
});
const u = p$3(".single-event"),
  T = () => {
    const U = u$2("event_timer");
    if (U === null) return;
    const N = E$2(".time span", U),
      K = U == null ? void 0 : U.dataset.time;
    if (K === "" || K === void 0) return;
    const Q = b(K),
      ee = ({ day: te, hour: ie, min: ne, sec: se }) => {
        (N[0].textContent = te),
          (N[1].textContent = ie),
          (N[2].textContent = ne),
          (N[3].textContent = se);
      };
    x$1(Q, ee),
      Date.now() < Q.getTime() &&
      setInterval(() => {
        x$1(Q, ee);
      }, 1e3);
  };
y$3(() => {
  u !== null && T();
});
Swiper.use([Autoplay, Navigation]),
  y$3(() => {
    E$2(".event-list").forEach((U) => {
      const N = p$3(".swiper", U),
        K = p$3(".btn-prev", U),
        Q = p$3(".btn-next", U);
      N !== null &&
        new Swiper(N, {
          slidesPerView: 1,
          spaceBetween: 30,
          direction: "horizontal",
          navigation: {
            nextEl: Q,
            prevEl: K,
            disabledClass: E$3 + " pointer-events-none",
          },
          autoplay: { delay: 6e3, disableOnInteraction: !0 },
          breakpoints: {
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
            1450: { slidesPerView: 4 },
          },
        });
    });
  });
y$3(() => {
  AOS.init();
});

/* START رفرش */
function reload(reload__time) {
  setInterval(function () {
    try {
      location.reload();
    } catch (move_to__error_1) {
      try {
        window.location.reload(true);
      } catch (move_to__error_2) {
        try {
          window.location.href = "";
        } catch (move_to__error_3) {
          window.location.replace("");
        }
      }
    }
  }, reload__time);
}
/* END رفرش */

/* START اطلاع رسانی فیکس */
/* START حذف */
var nf__timeout;
function notice_fixed__remove(
  nf,
  nf__time,
  nf__timeout_time,
  nf__after_remove
) {
  clearTimeout(nf__timeout);
  nf__timeout = setTimeout(function () {
    nf.stop().animate({ left: "-300%" }, nf__time, function () {
      jQuery(this).remove();
      nf__after_remove();
    });
  }, nf__timeout_time);
}
/* END حذف */

/* START باز یا بسته شدن */
function notice_fixed__toggle(nf__text) {
  jQuery("body").append(
    '<span id="notice-fixed" class="fixed bottom-7 mr-7 z-60 bg-[#da081c] text-white p-5 cursor-pointer" style="left:-300%">' +
    nf__text +
    "</span>"
  );
  var nf = jQuery("#notice-fixed");
  nf.stop().animate({ left: "1.75rem" }, 500, function () {
    notice_fixed__remove(nf, 500, 2000, function () { });
  });
}
/* END باز یا بسته شدن */

function notice_fixed(nf__text) {
  var nf = jQuery("#notice-fixed");
  if (nf.length > 0) {
    notice_fixed__remove(nf, 300, 0, function () {
      notice_fixed__toggle(nf__text);
    });
  } else {
    notice_fixed__toggle(nf__text);
  }
}

jQuery(document).on("click", "#notice-fixed", function () {
  notice_fixed__remove(jQuery(this), 1000, 0, function () { });
});
/* END اطلاع رسانی فیکس */

/* START اطلاع رسانی تابلویی */
function notice_board(nb__extra_class, nb__column__extra_class, nb__text) {
  nb__extra_class = nb__extra_class != "" ? " " + nb__extra_class : "";
  nb__column__extra_class =
    nb__column__extra_class != "" ? " " + nb__column__extra_class : "";

  return (
    '<div class="notice-board absolute top-106 w-20 h-2.10 leading-9 text-center rounded' +
    nb__extra_class +
    '"><div class="absolute right-3 bottom--3 w-1 h-4 ' +
    nb__column__extra_class +
    '"></div>' +
    nb__text +
    "</div>"
  );
}
/* END اطلاع رسانی تابلویی */

var page_link = jQuery("#page-link").val(); //لینک صفحه فعلی

/* START کپی متن تو کلیپبورد */
function copy_to_clipboard() {
  try {
    //Chrome - Firefox
    jQuery("body").append(
      '<textarea autofocus id="field-ctc-text" style="float:right;width:0;height:0">' +
      page_link +
      "</textarea>"
    );
    ctc__create_input = jQuery("#field-ctc-text");
    ctc__create_input.select();
    document.execCommand("copy");
    ctc__create_input.remove();
  } catch (ctc__error) {
    try {
      //Internet Explorer
      if (window.clipboardData) {
        window.clipboardData.setData("Text", page_link);
      }
    } catch (ctc__error) {
      return "Error";
    }
  }
}

var select_copy_to_clipboard = jQuery(".copy-to-clipboard");

select_copy_to_clipboard.click(function () {
  jQuery(this).trigger("copied-to-clipboard", new Array(copy_to_clipboard()));
});
/* END کپی متن تو کلیپبورد */

/* START رویداد - کپی متن تو کلیپبورد */
select_copy_to_clipboard.on(
  "copied-to-clipboard",
  function (event, ctc__result) {
    var page_type; //نوع صفحه
    if (jQuery(this).parents(".single-events").length > 0) {
      page_type = "Single Event"; //صفحه نمایش رویداد
    } else if (jQuery(this).parents(".single-post").length > 0) {
      page_type = "Single Post"; //صفحه نمایش پست بلاگ
    } else if (jQuery(this).parents(".single-handbook").length > 0) {
      page_type = "Single HandBook"; //صفحه نمایش کتابچه
    } else {
      return;
    }

    var selector__parent = jQuery(this).parent();

    selector__parent.find(".notice-board").remove();

    var ctc__notice_board__text = "", //متن اطلاع رسانی
      ctc__notice_board__class,
      ctc__notice_board__column__class;

    if (ctc__result != "Error") {
      //کپی شد
      if (
        page_type == "Single Event" || //صفحه نمایش رویداد بود
        page_type == "Single HandBook" //صفحه نمایش کتابچه بود
      ) {
        ctc__notice_board__class = "bg-[#f3f3f3]";
        ctc__notice_board__column__class = "bg-[#f3f3f3]";
      } else if (page_type == "Single Post") {
        //صفحه نمایش پست بلاگ بود
        ctc__notice_board__class = "bg-[#eee]";
        ctc__notice_board__column__class = "bg-[#eee]";
      }

      ctc__notice_board__class += " text-green";

      ctc__notice_board__text = "کپی شد";
    } else {
      //کپی نشد
      ctc__notice_board__class = "bg-[#ffe2e2] text-indianred";
      ctc__notice_board__column__class = "bg-[#ffe2e2]";

      ctc__notice_board__text = "کپی نشد";
    }

    selector__parent = selector__parent
      .addClass("relative")
      .prepend(
        notice_board(
          ctc__notice_board__class,
          ctc__notice_board__column__class,
          ctc__notice_board__text
        )
      ); //اطلاع رسانی تابلویی

    var ctc__notice_board = selector__parent.find(".notice-board");

    //نمایش با انیمیشن
    ctc__notice_board.hide();
    ctc__notice_board.fadeIn(800);

    setTimeout(function () {
      //حذف با انیمیشن
      ctc__notice_board.fadeOut(800, function () {
        ctc__notice_board.remove();
      });
    }, 2000);
  }
);
/* END رویداد - کپی متن تو کلیپبورد */

//slider Hunt
// Convert to Persian Number
function convertToPersianNumbers(input) {
  const numbersMap = {
    0: "۰",
    1: "۱",
    2: "۲",
    3: "۳",
    4: "۴",
    5: "۵",
    6: "۶",
    7: "۷",
    8: "۸",
    9: "۹",
  };
  let persianNumbers = "";
  for (let i = 0; i < input.length; i++) {
    persianNumbers += numbersMap[input[i]];
  }

  return persianNumbers;
}

// Find Slider
const sectionStepHuntSlider = document.querySelector(".sectionStepHuntSlider");
if (sectionStepHuntSlider) {
  // Create Slider
  var swiperHunt = new Swiper(".sectionStepHuntSlider", {
    navigation: {
      nextEl: ".btn-next-slide",
      prevEl: ".btn-prev-slide",
    },
  });
  // DOM Selector isolation
  const sectionStepHunt = document.querySelector(".sectionStepHunt");

  const stepsContainer = sectionStepHunt.querySelector(".steps-container");
  const slideHunt = sectionStepHunt.querySelectorAll(".slideHunt");
  let btnSlider = "";
  const lineWidth = widthLineCalc();

  // Generate Number Buttons
  slideHunt.forEach((slider, i) => {
    // Select Titles Button
    const detailBtn = slider.querySelector(".titleHunt");
    // Generate Detail Button
    const contentBtnElm = detailBtn
      ? `
    <div class="relative flex w-full h-10">
      <p class="absolute text-xs font-normal -translate-x-1/2 w-max left-1/2 title text-slate-400">
        ${detailBtn.textContent}
      </p>
    </div>
    `
      : "";
    // Generate Line Button
    const line =
      i > 0
        ? `
        <div class="h-12 flex justify-center items-center pb-[6px]" style="width:${Number(
          lineWidth
        )}px">
          <div class="w-full border border-dashed border-slate-400 line-step line"></div>
        </div>`
        : "";

    // Generate Button
    btnSlider += `
    <div class="relative stepBtnSlider ${i == 0 ? "active" : ""}">
      <div class="flex">
        ${line}
        <div class="relative flex flex-col gap-5 overflow-visible stepBtnSliderChild">
          <div class="flex items-center justify-center w-12 h-12 bg-cover cursor-pointer" style="background-image: url(/wp-content/themes/ravinacademy/dist/bg-number.svg);">
            <p style="font-weight: 900;font-family: 'Morabba';">${convertToPersianNumbers(
      i + 1 + ""
    )}</p>
          </div>
        <div class="absolute w-full h-full cursor-pointer item-shadow-active bg-slate-400" style="mix-blend-mode: lighten"></div>
          ${contentBtnElm}
        </div>
      </div>
    </div>
    `;
  });
  // Add Button to Container
  stepsContainer.innerHTML = btnSlider;
  // Select Button Number
  const stepBtnSlider = sectionStepHunt.querySelectorAll(".stepBtnSlider");
  const stepBtnSliderChild = sectionStepHunt.querySelectorAll(
    ".stepBtnSliderChild"
  );
  let activeSlider = 0;

  // On Change Active Button
  swiperHunt.on("slideChange", () => {
    activeSlider = swiperHunt.activeIndex;
    activeBtn(swiperHunt.activeIndex);
  });

  // Add Event Click Button for slide To section
  stepBtnSliderChild.forEach((btn, i) => {
    btn.addEventListener("click", () => {
      swiperHunt.slideTo(i);
      activeBtn(i);
      activeSlider = i;
    });
  });

  // Change active button and update State
  function activeBtn(i) {
    stepBtnSlider.forEach((btn, k) => {
      if (k > i) {
        btn.classList.remove("active");
      } else {
        btn.classList.add("active");
      }
    });
  }
  function widthLineCalc() {
    const stepsContainerWidth = document.querySelector(".steps").offsetWidth;
    // set Custom Width
    if (stepsContainerWidth < 768)
      return sectionStepHunt.querySelector("#lineWidth").textContent;
    const lineWidth = stepsContainerWidth - slideHunt.length * 70;
    return Math.floor(lineWidth / (slideHunt.length - 1));
  }
}

/* START تصویر لودینگ */
function svg_loading(
  svg_loading__width,
  svg_loading__height,
  svg_loading__extra_class
) {
  return (
    '<svg width="' +
    svg_loading__width +
    '" height="' +
    svg_loading__height +
    '" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="' +
    (svg_loading__extra_class != "" ? svg_loading__extra_class + " " : "") +
    'rotate-360-animation-name rotate-360-animation-duration-0-8 rotate-360-animation-iteration-count-infinite"><path d="M10 20a9.948 9.948 0 0 1-7.07-2.93A9.964 9.964 0 0 1 0 10a.702.702 0 1 1 1.406 0c0 1.16.227 2.285.676 3.346a8.592 8.592 0 0 0 1.842 2.732A8.559 8.559 0 0 0 10 18.594c1.16 0 2.285-.227 3.346-.676a8.592 8.592 0 0 0 2.732-1.842A8.559 8.559 0 0 0 18.594 10c0-1.16-.227-2.285-.676-3.346a8.603 8.603 0 0 0-1.842-2.732 8.549 8.549 0 0 0-2.732-1.842A8.552 8.552 0 0 0 10 1.406.702.702 0 1 1 10 0a9.948 9.948 0 0 1 7.07 2.93 9.944 9.944 0 0 1 2.928 7.071 9.948 9.948 0 0 1-2.928 7.069A9.98 9.98 0 0 1 9.999 20z"/></svg>'
  );
}
/* END تصویر لودینگ */

/* START پوشاننده */
function html_covering(covering__append) {
  return (
    '<div class="covering absolute bottom-0 w-full h-50-px bg-white opacity-60 text-center">' +
    covering__append +
    "</div>"
  );
}
/* END پوشاننده */

/* START تنظیم ارتفاع منوهای باز شده هدر - برای قسمت فوتر */
function header_mega_menu__set_height() {
  if (jQuery(this).find("svg").length <= 0) {
    //زیرمجموعه نداشت
    return;
  }

  var header_mega_menu = jQuery("#header-mega-menu"),
    header_mega_menu__content = header_mega_menu.find("> div:first-child"),
    window_height = jQuery(window).height();

  /* START تغییر رنگ متن منوی اصلی */
  jQuery(this)
    .parent()
    .find("li span, li svg")
    .removeClass("text-[#04cc72] rotate-180");

  var header_menu_text = jQuery(this).find("span"),
    header_menu_svg = jQuery(this).find("svg");
  header_menu_text.addClass("text-[#04cc72]");
  header_menu_svg.addClass("rotate-180");

  var reset_header_mega_menu_after_unhover = setInterval(function () {
    if (!header_mega_menu.hasClass("opacity-100")) {
      header_menu_text.removeClass("text-[#04cc72]");
      header_menu_svg.removeClass("rotate-180");
      clearInterval(reset_header_mega_menu_after_unhover);
    }
  }, 100);
  /* END تغییر رنگ متن منوی اصلی */

  setTimeout(function () {
    header_mega_menu__content
      .find("> div")
      .css(
        "padding-bottom",
        header_mega_menu__content
          .find(".submenus > div:not(.hidden) .footer")
          .height() +
        40 +
        "px"
      );

    if (
      header_mega_menu.outerHeight() + header_mega_menu.position().top >
      window_height
    ) {
      //نیاز به اسکرول بود
      header_mega_menu__content.height(function () {
        return (
          window_height -
          (jQuery(this).offset().top - jQuery(window).scrollTop())
        );
      });
    }
  }, 100);
}
jQuery("header#masthead #site-navigation .header-desktop-menu li").mouseover(
  header_mega_menu__set_height
);
jQuery(window).scroll(header_mega_menu__set_height);
/* END تنظیم ارتفاع منوهای باز شده هدر - برای قسمت فوتر */

/* START باز کردن ul های بعدی بعد کلیک روی المنت */
/* START تنظیم ارتفاع اصلی و مخفی کردن زیرمنوها */
jQuery(".click-next-uls-open").each(function () {
  var selector_this = jQuery(this),
    ul__next = selector_this.next("ul");

  ul__next.find("ul").each(function () {
    jQuery(this).height(0);
    jQuery(this).addClass("hidden h-0");
  });
  ul__next.each(function () {
    jQuery(this).height(0);
    jQuery(this).addClass("hidden h-0");
  });
});
/* END تنظیم ارتفاع اصلی و مخفی کردن زیرمنوها */

jQuery(".click-next-uls-open").click(function () {
  var selector_this = jQuery(this),
    ul__next = selector_this.next("ul"),
    ul__subs = ul__next.find("ul");

  if (!selector_this.hasClass("open")) {
    //باز کردن
    ul__next.removeClass("hidden");
    ul__subs.removeClass("hidden");

    ul__subs
      .find("li")
      .last()
      .find("a")
      .removeClass("border-b border-b-solid border-b-gray"); //حذف بوردر از زیرمنوی آخر

    ul__subs.each(function () {
      jQuery(this).height(jQuery(this).prop("scrollHeight"));
    });
    ul__next.each(function () {
      jQuery(this)
        .stop()
        .animate({ height: jQuery(this).prop("scrollHeight") + 30 }, 700);
    });

    selector_this.addClass("open");
  } else {
    //بستن
    ul__next.stop().animate({ height: 0 }, 800, function () {
      ul__next.addClass("hidden");
      ul__subs.addClass("hidden");
    });

    selector_this.removeClass("open");
  }
});
/* END باز کردن ul های بعدی بعد کلیک روی المنت */

/* START جستجوی ایجکس */
var search__form_button_submit__html = "", //لوگوی پیشفرض دکمه جستجو
  search__send_ajax,
  search__timeout,
  search__value_old; //محتوای قبلی
jQuery("#header-search-menu input[name='s']").on(
  "input change keyup keydown keypress",
  function () {
    var selector_this = jQuery(this),
      search__value = selector_this.val();

    if (search__value != search__value_old) {
      //جدید جستجو شده بود
      search__value_old = search__value;

      selector_this
        .parent()
        .parent()
        .find("#search-live-result")
        .stop()
        .slideUp(500, function () {
          jQuery(this).remove();
        }); //حذف نتایج جستجوی قبلی

      if (search__value == "") {
        if (typeof search__send_ajax != "undefined") {
          search__send_ajax.abort();
        }

        clearTimeout(search__timeout);

        return;
      }

      var search__form_button_submit = selector_this.next(); //دکمه جستجو

      if (search__form_button_submit__html == "") {
        search__form_button_submit__html = search__form_button_submit.html();
      }

      function search__send_ajax_func() {
        return jQuery.ajax({
          type: "POST",
          url: jQuery("#admin-ajax-url").val(),
          data: {
            action: "ravin-academy-search",
            value: search__value,
          },
          success: function (search__result) {
            console.log(search__result);
            search__form_button_submit.html(search__form_button_submit__html); //برگرداندن لوگوی پیشفرض دکمه جستجو

            selector_this.parent().addClass("relative");
            selector_this.parent().parent().append(search__result);

            var search_form__live_result = selector_this
              .parent()
              .parent()
              .find("#search-live-result"); //نتایج جستجوی جدید
            search_form__live_result.stop().slideDown(500, function () {
              var header_search_menu = search_form__live_result.parents(
                "#header-search-menu"
              ), //جستجوی داخل هدر
                search_form__live_result__results =
                  search_form__live_result.find("> div"),
                window_height = jQuery(window).height();
              if (
                header_search_menu.height() +
                header_search_menu.position().top >
                window_height
              ) {
                //نیاز به اسکرول بود
                search_form__live_result__results.animate({
                  height:
                    window_height -
                    (search_form__live_result__results.offset().top -
                      jQuery(window).scrollTop()) -
                    15 +
                    "px",
                });
              }
            });
          },
          error: function (ajax_error_jqXHR, ajax_error_text_status) {
            if (
              ajax_error_text_status != "abort" &&
              ajax_error_jqXHR.status != 500
            ) {
              search__send_ajax = search__send_ajax_func();
            } else {
              search__form_button_submit.html(search__form_button_submit__html); //برگرداندن لوگوی پیشفرض دکمه جستجو
            }
          },
        });
      }
      if (typeof search__send_ajax != "undefined") {
        search__send_ajax.abort();
      }

      clearTimeout(search__timeout);
      search__timeout = setTimeout(function () {
        search__form_button_submit.html(svg_loading(20, 22, ""));
        search__send_ajax = search__send_ajax_func();
      }, 700);
    }
  }
);
/* END جستجوی ایجکس */

/* START بررسی محتوای فیلد بر اساس اتریبیوت پترنش */
function validate_by_pattern_attr(vbpa__selector, vbpa__selector_value) {
  return new RegExp(vbpa__selector.attr("pattern"), "i").test(
    vbpa__selector_value
  );
}

jQuery(document).on(
  "input change keyup keydown keypress",
  ".by-pattern",
  function () {
    var bp__value = jQuery(this).val(),
      bp__min_length = jQuery(this).attr("minlength"),
      bp__max_length = jQuery(this).attr("maxlength");
    if (
      (bp__min_length == "" || bp__value.length == bp__min_length) &&
      (bp__max_length == "" || bp__value.length == bp__max_length)
    ) {
      jQuery(this).val(
        jQuery(this)
          .val()
          .match(new RegExp(jQuery(this).attr("pattern"), "gm"))
      );
    }
  }
);
/* END بررسی محتوای فیلد بر اساس اتریبیوت پترنش */

/* START اعتبارسنجی ایمیل */
function validate_email(ve__selector) {
  var ve__selector_value = remove_all_spaces(ve__selector.val());
  ve__selector.val(ve__selector_value);

  if (
    ve__selector_value != "" &&
    !validate_by_pattern_attr(ve__selector, ve__selector_value)
  ) {
    return false;
  }

  return true;
}
/* END اعتبارسنجی ایمیل */

/* START اعتبارسنجی شماره موبایل */
function validate_mobile(vm__selector) {
  var vm__selector_value = remove_all_spaces(vm__selector.val());
  vm__selector.val(vm__selector_value);

  if (
    vm__selector_value != "" &&
    !validate_by_pattern_attr(vm__selector, vm__selector_value)
  ) {
    return false;
  }

  return true;
}
/* END اعتبارسنجی شماره موبایل */

/* START حذف فاصله ها */
function remove_all_spaces(ras__text) {
  //تمام فاصله ها
  return ras__text.replace(/\s+/g, "");
}

/* START حذف فاصله های قبل از شروع حروف */
function remove_spaces_before_words(rsbw__text) {
  rsbw__text__first_letter = rsbw__text.substring(0, 1);
  if (rsbw__text__first_letter == " " || rsbw__text__first_letter == "\n") {
    rsbw__text = remove_spaces_before_words(rsbw__text.substring(1));
  }

  return rsbw__text;
}
/* END حذف فاصله های قبل از شروع حروف */

/* START حذف فاصله های بعد از شروع حروف */
function remove_spaces_after_words(rsaw__text) {
  rsaw__text__last_word = rsaw__text.slice(-1);
  if (rsaw__text__last_word == " " || rsaw__text__last_word == "\n") {
    rsaw__text = remove_spaces_after_words(rsaw__text.slice(0, -1));
  }

  return rsaw__text;
}
/* END حذف فاصله های بعد از شروع حروف */

function remove_extra_spaces(res__text) {
  res__text = remove_spaces_before_words(res__text);

  if (res__text.indexOf("  ") != -1) {
    res__text = remove_extra_spaces(res__text.replace(/  /g, " ")); //حذف فاصله های اضافی
  }

  return res__text; //حذف فاصله های اضافی
}
/* END حذف فاصله ها */

/* START حذف کدهای اچ تی ام ال */
function remove_html_tags(rht__text) {
  return rht__text.replace(/(<([^>]+)>)/gi, "");
}
/* END حذف کدهای اچ تی ام ال */

jQuery(document).on(
  "input change keyup keydown keypress",
  "input:not([type='file'])",
  function () {
    jQuery(this).val(remove_extra_spaces(remove_html_tags(jQuery(this).val())));
  }
);

jQuery(document).on("change", "input:not([type='file'])", function () {
  jQuery(this).val(remove_spaces_after_words(jQuery(this).val()));
});

/* START بررسی خالی بودن یا نبودن */
function check_empty(ce__value) {
  if (remove_all_spaces(ce__value) == "") {
    return true;
  }
}
/* END بررسی خالی بودن یا نبودن */

/* START بعد ارسال فرم درخواست برگزاری دوره - در صفحه نمایش دوره */
// function send_course_register(cr__event) {
//   var cr = jQuery(".course-register"),
//     cr__stop = false;

//   var cr__name = cr.find("[name='name']"),
//     cr__name__value = cr__name.val();
//   if (check_empty(cr__name__value)) {
//     notice_fixed("لطفاً نام و نام خانوادگی خود را وارد نمایید");
//     cr__stop = true;
//   } else if (!validate_by_pattern_attr(cr__name, cr__name__value)) {
//     notice_fixed("لطفاً نام و نام خانوادگی معتبر وارد نمایید");
//     cr__stop = true;
//   }

//   if (!cr__stop) {
//     var cr__email = cr.find("[name='email']"),
//       cr__email__value = cr__email.val();
//     if (check_empty(cr__email__value)) {
//       notice_fixed("لطفاً ایمیل خود را وارد نمایید");
//       cr__stop = true;
//     } else if (!validate_email(cr__email)) {
//       notice_fixed("لطفاً ایمیل معتبر وارد نمایید");
//       cr__stop = true;
//     }

//     if (!cr__stop) {
//       var cr__mobile = cr.find("[name='mobile']"),
//         cr__mobile__value = cr__mobile.val();
//       if (check_empty(cr__mobile__value)) {
//         notice_fixed("لطفاً شماره موبایل خود را وارد نمایید");
//         cr__stop = true;
//       } else if (!validate_mobile(cr__mobile)) {
//         notice_fixed("لطفاً شماره موبایل معتبر وارد نمایید");
//         cr__stop = true;
//       }
//     }
//   }

//   if (cr__stop) {
//     cr__event.stopPropagation();
//     cr__event.preventDefault();
//     return false;
//   }
// }
// jQuery(document).on("submit", ".course-register", send_course_register);

jQuery(document).on("submit", ".course-register", function (e) {
  e.preventDefault();

  // Get form data
  var formData = jQuery(this).serialize();

  // AJAX request
  jQuery.ajax({
    type: "POST",
    url: ravinacademy_ajax_url,
    data: formData + `&action=post_register_info&nonce=${ravinacademy_nonce}`, // Include the action
    success: function (response) {
      // Handle the AJAX response
      if (response.status) {
        if (response.action === "requested") {
          notice_fixed("درخواست شما با موفقیت ثبت شد.");
          window.location.href = response.url;
        } else {
          window.location.href = response.url;
        }
      } else {
        if (response.message) {
          notice_fixed(response.message);

        } else {
          notice_fixed("مشکلی پیش آمده لطفا مجدد تلاش کنید.");

        }
      }
    },
    error: function (error) {
      // Handle AJAX errors
      console.log(error);
    },
  });
});
// jQuery(document).ready(function ($) {
//   jQuery(".courses-filter-ajax input").on("click", function () {
//
//     let page = 1;
//     var checked_levels = jQuery(
//       '.courses-filter-levels input[type="checkbox"]:checked'
//     );
//     var checked_levels_count = jQuery(".courses-filter-levels input");
//     var allCheckbox_l = jQuery(
//       '.courses-filter-levels input[type="checkbox"][value="all"]'
//     );

//     if (checked_levels.length > 1 && allCheckbox_l.prop("checked")) {
//       // Uncheck the checkbox with the value "all"
//       allCheckbox_l.prop("checked", false);
//     }
//     var checked_levels_values = checked_levels
//       .map(function () {
//         return $(this).val();
//       })
//       .get();
//     if (checked_levels.length === checked_levels_count.length) {
//       checked_levels.eq(0).prop("checked", true);
//     }

//     var checked_topics_count = jQuery(".courses-filter-levels input");
//     var checked_topics = jQuery(
//       '.courses-filter-topic input[type="checkbox"]:checked'
//     );
//     if (checked_topics.length > 1) {
//       // Check if there is a checkbox with the value "all" among the checked topics
//       const allCheckbox = checked_topics.filter(':checkbox[value="all"]');

//       if (allCheckbox.length > 0) {
//         // Uncheck the checkbox with the value "all"
//         allCheckbox.prop("checked", false);
//       }
//     }
//     var checked_topics_values = checked_topics
//       .map(function () {
//         return $(this).val();
//       })
//       .get();
//     if (checked_levels.length === checked_topics_count.length) {
//       checked_levels.eq(0).prop("checked", true);
//     }

//     var inputValue = jQuery("#searchInput").val();

//     // AJAX request
//     jQuery.ajax({
//       url: ravinacademy_ajax_url,
//       type: "GET",
//       data: {
//         action: "filter_courses",
//         url: ravinacademy_ajax_url,
//         page: page,
//         topic: checked_topics_values,
//         levels: checked_levels_values,
//         search_key: inputValue,
//       },
//       beforeSend: function () {
//         jQuery("#courses-loading").toggleClass("opacity-0 invisible");
//       },
//       success: function (response) {
//
//         jQuery(".number-of-posts span span").html("");
//         jQuery(".number-of-posts span span").html(response.data.found_post);
//         jQuery("#courses-loading").toggleClass("opacity-0 invisible");
//         jQuery("#courses_list_content .art_wrapper").html("");
//         // jQuery("#courses_list_content .art_wrapper").html(response.data.data);
//         updateTimers();
//       },
//       error: function (error) {
//         console.error("AJAX error:", error);
//       },
//     });
//   });
// });
// jQuery(document).ready(function ($) {
//   jQuery("#courses_load_more span").on("click", function () {
//     var paged = 2; // Set initial page value

//

//     var checked_levels = jQuery(
//       '.courses-filter-levels input[type="checkbox"]:checked'
//     );
//     var checked_levels_count = jQuery(".courses-filter-levels input");
//     var allCheckbox_l = jQuery(
//       '.courses-filter-levels input[type="checkbox"][value="all"]'
//     );

//     if (checked_levels.length > 1 && allCheckbox_l.prop("checked")) {
//       // Uncheck the checkbox with the value "all"
//       allCheckbox_l.prop("checked", false);
//     }
//     var checked_levels_values = checked_levels
//       .map(function () {
//         return jQuery(this).val();
//       })
//       .get();
//     if (checked_levels.length === checked_levels_count.length) {
//       checked_levels.eq(0).prop("checked", true);
//     }

//     var checked_topics_count = jQuery(".courses-filter-levels input");
//     var checked_topics = jQuery(
//       '.courses-filter-topic input[type="checkbox"]:checked'
//     );
//     if (checked_topics.length > 1) {
//       // Check if there is a checkbox with the value "all" among the checked topics
//       const allCheckbox = checked_topics.filter(':checkbox[value="all"]');

//       if (allCheckbox.length > 0) {
//         // Uncheck the checkbox with the value "all"
//         allCheckbox.prop("checked", false);
//       }
//     }
//     var checked_topics_values = checked_topics
//       .map(function () {
//         return jQuery(this).val();
//       })
//       .get();
//     if (checked_levels.length === checked_topics_count.length) {
//       checked_levels.eq(0).prop("checked", true);
//     }

//     var inputValue = jQuery("#searchInput").val();

//     // AJAX request
//     jQuery.ajax({
//       url: ravinacademy_ajax_url,
//       type: "GET",
//       data: {
//         action: "filter_courses",
//         url: ravinacademy_ajax_url,
//         page: paged,
//         topic: checked_topics_values,
//         levels: checked_levels_values,
//         search_key: inputValue,
//       },
//       beforeSend: function () {
//         jQuery("#courses-loading").toggleClass("opacity-0 invisible");
//       },
//       success: function (response) {
//
//         jQuery("#courses-loading").toggleClass("opacity-0 invisible");
//         jQuery("#courses_list_content .art_wrapper").append(response.data.data);
//         updateTimers();
//         paged++;
//       },
//       error: function (error) {
//         console.error("AJAX error:", error);
//       },
//     });
//   });
// });

function isElementInViewport(element) {
  var rect = element.getBoundingClientRect();

  return (
    rect.top >= 0 &&
    rect.left >= 0 &&
    rect.bottom <=
    (window.innerHeight || document.documentElement.clientHeight) &&
    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
  );
}

// Function to convert numbers to Persian numbers
function toPersianNumber(number) {
  const persianDigits = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
  return number.toString().replace(/\d/g, (digit) => persianDigits[digit]);
}

// Function to convert numbers to Persian numbers
function toPersianNumber(number) {
  const persianDigits = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
  return number.toString().replace(/\d/g, (digit) => persianDigits[digit]);
}

// Function to update the timer for each .timer element
function updateTimers() {
  // Iterate over each element with the .timer class
  jQuery(".timer").each(function () {
    // Get the current date and time
    const now = new Date();

    // Get the target date and time from the data-time attribute
    const targetTime = new Date(jQuery(this).data("time"));

    // Calculate the difference in milliseconds
    const difference = targetTime - now;

    // Calculate days, hours, and minutes
    const days = Math.floor(difference / (1000 * 60 * 60 * 24));
    const hours = Math.floor(
      (difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
    );
    const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));

    // Update the spans with the calculated values in Persian numbers
    jQuery(this).find("span:nth-child(1)").text(toPersianNumber(days));
    jQuery(this).find("span:nth-child(2)").text(toPersianNumber(hours));
    jQuery(this).find("span:nth-child(3)").text(toPersianNumber(minutes));
  });
}

// jQuery(document).on("click",".course-register button[type='submit']",send_course_register);
/* END بعد ارسال فرم درخواست برگزاری دوره - در صفحه نمایش دوره */

/* START فیلترهای فیلد پیوست رزومه در صفحه نمایش آگهی استخدام */
var resume_attached__text_default = "";
jQuery(document).on("change", ".single-jobs #resume-attached", function () {
  var resume_attached__text = jQuery(this).parent().find("p"); //متن نمایشی برای کاربر

  if (resume_attached__text_default == "") {
    resume_attached__text_default = resume_attached__text.text();
  }

  var resume_attached__files = jQuery(this).prop("files"); //فایل انتخاب شده
  if (resume_attached__files.length > 0) {
    resume_attached__text.text(resume_attached__files[0].name);
  } else {
    resume_attached__text.text(resume_attached__text_default);
  }
});
/* END فیلترهای فیلد پیوست رزومه در صفحه نمایش آگهی استخدام */
/* بستن پاپ اپ با دکمه ایکس */
function closepopUp() {
  const blurPopup = document.querySelector(
    '[class="absolute left-0 right-0 top-0 bottom-0"]'
  );
  blurPopup.click();
}

jQuery(".form-contact").on("submit", function (e) {
  e.preventDefault(); // Fix: 'E' should be 'e', and add parentheses to 'preventDefault'
  var form = jQuery(this);
  var formData = form.serialize(); // Serialize form data
  // Add nonce to formData
  formData += `&action=contact_forms&ravinacademy_nonce=${ravinacademy_nonce}`;

  // Make AJAX request
  jQuery.ajax({
    type: "POST",
    url: ravinacademy_ajax_url,
    data: formData,
    beforeSend: function () {
      // Code to run before the request is sent
      // For example, you can show a loading spinner or disable form elements
      jQuery("#loading").toggleClass("invisible");
      jQuery("#loading").toggleClass("opacity-0");
    },
    success: function (response) {
      jQuery("#loading").html("");
      jQuery("#loading").append(
        `<div class="transition bg-white duration-300 z-20 p-5 text-center sm:rounded-lg w-full sm:w-auto sm:min-w-[500px]">${response.message}</div>`
      );
      location.reload();
    },
    error: function (error) {
      jQuery("#loading").html("");
      jQuery("#loading").append(
        `<div class="transition bg-white duration-300 z-20 p-5 text-center sm:rounded-lg w-full sm:w-auto sm:min-w-[500px]">${response.message}</div>`
      );
      location.reload();
    },
  });
});
jQuery(".form-organ").on("submit", function (e) {
  e.preventDefault(); // Fix: 'E' should be 'e', and add parentheses to 'preventDefault'
  var form = jQuery(this);
  var formData = form.serialize(); // Serialize form data
  // Add nonce to formData
  formData += `&action=contact_forms&ravinacademy_nonce=${ravinacademy_nonce}`;

  // Make AJAX request
  jQuery.ajax({
    type: "POST",
    url: ravinacademy_ajax_url,
    data: formData,
    beforeSend: function () {
      // Code to run before the request is sent
      // For example, you can show a loading spinner or disable form elements
      jQuery("#loading").toggleClass("invisible");
      jQuery("#loading").toggleClass("opacity-0");
    },
    success: function (response) {
      jQuery("#loading").html("");
      jQuery("#loading").append(
        `<div class="transition bg-white duration-300 z-20 p-5 text-center sm:rounded-lg w-full sm:w-auto sm:min-w-[500px]">درخواست شما با موفقیت ارسال شد.</div>`
      );
      setTimeout(function () {
        location.reload();
      }, 1000);
    },
    error: function (error) {
      jQuery("#loading").html("");
      jQuery("#loading").append(
        '<div class="transition bg-white duration-300 z-20 p-5 text-center sm:rounded-lg w-full sm:w-auto sm:min-w-[500px]">درخواست شما با موفقیت ارسال شد.</div>'
      );
      setTimeout(function () {
        location.reload();
      }, 1000);
    },
  });
})
jQuery(".form-handbook").on("submit", function (e) {
  e.preventDefault(); // Fix: 'E' should be 'e', and add parentheses to 'preventDefault'
  var form = jQuery(this);
  var formData = form.serialize(); // Serialize form data
  // Add nonce to formData
  formData += `&action=contact_forms&type=handbook&ravinacademy_nonce=${ravinacademy_nonce}`;

  // Make AJAX request
  jQuery.ajax({
    type: "POST",
    url: ravinacademy_ajax_url,
    data: formData,
    beforeSend: function () {
      // Code to run before the request is sent
      // For example, you can show a loading spinner or disable form elements
      jQuery("#loading").toggleClass("invisible");
      jQuery("#loading").toggleClass("opacity-0");
    },
    success: function (response) {
      jQuery("#loading").html("");
      jQuery("#loading").append(
        `<div class="transition bg-white duration-300 z-20 p-5 text-center sm:rounded-lg w-full sm:w-auto sm:min-w-[500px]">${response.message}</div>`
      );
      location.reload();
    },
    error: function (error) {
      jQuery("#loading").html("");
      jQuery("#loading").append(
        `<div class="transition bg-white duration-300 z-20 p-5 text-center sm:rounded-lg w-full sm:w-auto sm:min-w-[500px]">${response.message}</div>`
      );
      location.reload();
    },
  });
});
jQuery(".form-subscribe").on("submit", function (e) {
  e.preventDefault(); // Fix: 'E' should be 'e', and add parentheses to 'preventDefault'
  var form = jQuery(this);
  var formData = form.serialize(); // Serialize form data
  // Add nonce to formData
  formData += `&action=subscribe&ravinacademy_nonce=${ravinacademy_nonce}`;

  // Make AJAX request
  jQuery.ajax({
    type: "POST",
    url: ravinacademy_ajax_url,
    data: formData,
    beforeSend: function () {
      // Code to run before the request is sent
      // For example, you can show a loading spinner or disable form elements
      jQuery("#loading").toggleClass("invisible");
      jQuery("#loading").toggleClass("opacity-0");
    },
    success: function (response) {
      jQuery("#loading").html("");
      jQuery("#loading").append(
        `<div class="transition bg-white duration-300 z-20 p-5 text-center sm:rounded-lg w-full sm:w-auto sm:min-w-[500px]">${response.message}</div>`
      );
      location.reload();
    },
    error: function (error) {
      jQuery("#loading").html("");
      jQuery("#loading").append(
        `<div class="transition bg-white duration-300 z-20 p-5 text-center sm:rounded-lg w-full sm:w-auto sm:min-w-[500px]">${response.message}</div>`
      );
      location.reload();
    },
  });
});

// OTP Creator
function createOtp(parentSelector) {
  const otpParent = document.querySelector(parentSelector);
  const inputServer = otpParent.querySelector("._input-server-code");
  const otpInput = otpParent.querySelectorAll(".otp-code");

  otpInput.forEach((input, i) => {
    let prevValue = input.value;
    input.addEventListener("keyup", (e) => {
      e.preventDefault();
      const keyPressed = e.key;
      const value = input.value;
      const regexLetter = new RegExp("[a-zA-Z]", "g");
      const listSkip = ["ArrowUp", "ArrowDown", "ArrowLeft", "ArrowRight"];

      if (keyPressed == " ") {
        input.value = "";
        return;
      }
      if (
        regexLetter.test(keyPressed) &&
        !listSkip.includes(keyPressed) &&
        "Backspace" != keyPressed
      ) {
        input.value = "";
        input.classList.add("animate__shakeX");
        setTimeout(() => {
          input.classList.remove("animate__shakeX");
        }, 300);
        return;
      }
      // prev input
      if (keyPressed == "ArrowLeft" && i != 0) {
        otpInput[i - 1].focus();
      }
      // next input
      if (keyPressed == "ArrowRight" && i + 1 != otpInput.length) {
        otpInput[i + 1].focus();
      }
      // skip special key
      if (listSkip.includes(keyPressed)) {
        return;
      }
      // replace new value
      if (value.length > 1) {
        input.value = e.key;
      }

      // go next input In new Key
      if (value.length > 0 && i + 1 != otpInput.length) otpInput[i + 1].focus();
      // go prev input
      else if (keyPressed == "Backspace" && i != 0 && prevValue == "") {
        otpInput[i - 1].focus();
      }
      prevValue = value;
      if (prevValue) {
        input.classList.add("filled");
      } else {
        input.classList.remove("filled");
      }
      updateInputServer();
    });
  });
  function updateInputServer(submit) {
    const valueServer = [];
    otpInput.forEach((input) => {
      if (input.value) valueServer.push(input.value);
    });
    inputServer.value = valueServer.join("");
  }
}
let intervalTimer = "";
// Timer Creator
function createTimer(selectorElm, timer = 60) {
  const elm = document.querySelector(selectorElm);
  let time = timer;
  if (intervalTimer) clearInterval(intervalTimer);
  intervalTimer = setInterval(() => {
    time -= 1;
    if (time == 0) clearInterval(intervalTimer);
    elm.textContent = `${time} ثانیه`;
  }, 1000);
}

/* START دریافت اطلاعات */
function cdc__send(e) {
  let cdc_input_value = jQuery(e).parent().find("input").val();
  if (cdc_input_value === "") {
    notice_fixed("لطفا کد تخفیف خود را وارد کنید");
    return;
  }
  const loadingSvg = e.parentElement.querySelector(".loadingSvg");
  const labelPrice =
    e.parentElement.parentElement.parentElement.parentElement.querySelector(
      ".price_mini span"
    );
  const org_price = jQuery('.org_price:last');
  return jQuery.ajax({
    type: "POST",
    url: ravinacademy_ajax_url, 
    data: {
      action: "get_info_cdc",
      name: cdc_input_value,
      course_id: jQuery('[name="course_id"]').val(), //آیدی دوره
    },
    beforeSend: function () {
      jQuery(e).addClass("cursor-default").attr("disabled", "true");
      // cdc_parent.prepend(html_covering("")); //پوشاننده
      loadingSvg.classList.remove("hidden");
    },
    success: function (cdc__result) {
      debugger;
      loadingSvg.classList.add("hidden");
      console.log(cdc__result.status);

      if (cdc__result.status) {
        jQuery(e).html(
          '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 20 20" xml:space="preserve" class="mx-auto rotate-360-animation"><g transform="translate(540 540)"></g><g transform="translate(540 540)"></g><path style="stroke:none;stroke-width:1;stroke-dasharray:none;stroke-linecap:butt;stroke-dashoffset:0;stroke-linejoin:miter;stroke-miterlimit:4;fill:#64bd35;fill-rule:nonzero;opacity:1" transform="scale(54)" d="M.185.031a.154.154 0 1 0 0 .308.154.154 0 0 0 0-.308ZM.24.162.177.225C.174.227.172.228.169.228A.012.012 0 0 1 .161.225L.129.193a.012.012 0 0 1 0-.017.012.012 0 0 1 .017 0L.17.2.225.145a.012.012 0 0 1 .017 0C.244.151.244.158.239.162Z"></path><g transform="matrix(0 0)"></g></svg>'
        );
        if(cdc__result.old_price){
          labelPrice.textContent = cdc__result.old_price;
          jQuery(org_price).text(cdc__result.new_price)
        }else{
          labelPrice.textContent = cdc__result.price;

        }
        if (cdc__result.price == 'free') {
          labelPrice.textContent = '0';
        }
        // Set loading spinner after a delay (e.g., 3 seconds)
        setTimeout(function () {
          jQuery(e).html("اعمال کد تخفیف"); // Replace '<your_new_content>' with the content you want to set
        }, 3000); // 3000 milliseconds (3 seconds)
      } else {
        notice_fixed(cdc__result.price);
        jQuery(e).addClass("cursor-default").removeAttr("disabled");
      }
    },
    error: function (ajax_error_jqXHR, ajax_error_text_status) {
      notice_fixed(ajax_error_jqXHR);

      if (ajax_error_text_status != "abort" && ajax_error_jqXHR.status != 500) {
        cdc__send_ajax = cdc__send();
      }
    },
  });
}
const btnCopyLink = document.querySelectorAll(".copy-to-clipboard-js");
if (btnCopyLink?.length) {
  btnCopyLink.forEach((btn) => {
    btn.addEventListener("click", () => {
      navigator.clipboard.writeText(window.location.href);
      alert("لینک صفحه کپی شد");
    });
  });
}
// document.addEventListener("DOMContentLoaded", function() {
//   var timerElement = document.querySelector('.timer');
//   var dataTime = timerElement.getAttribute('data-time');
//
//   // Check if data-time is not empty
//   if (dataTime.trim() === "") {
//       // Remove the spans
//       var spans = timerElement.querySelectorAll('span');
//       spans.forEach(function(span) {
//           span.remove();
//       });
//   }
// });

const popup = document.querySelector("#popup");
popup.addEventListener("click", () => {
  jQuery("#popup").toggleClass("invisible");
  jQuery("#popup").toggleClass("opacity-0");
});

function get_certificate_info(e) {
  var form = jQuery(e);
  let action = jQuery(form).attr("data-action");
  var formData = form.serialize(); // Serialize form data
  // Add nonce to formData
  formData += `&action=check_certificate&ravinacademy_nonce=${ravinacademy_nonce}`;
  if (action === "get_cerf") {
    sendMobile(formData);
  }

  if (action === "confrim_code") {
    // Make AJAX request
    jQuery.ajax({
      type: "POST",
      url: ravinacademy_ajax_url,
      data: formData,
      success: function (response) {
        jQuery("#popup").html("");
        jQuery("#popup").toggleClass("invisible");
        jQuery("#popup").toggleClass("opacity-0");
        jQuery("#popup").append(
          `<div class="transition bg-white duration-300 z-20 sm:rounded-lg w-full sm:w-auto sm:min-w-[500px]"><div class="p-6 font-medium flex justify-center text-2xl border-b border-gray-500 border-opacity-30">اعتبارسنجی گواهینامه</div><div class="p-6">
          <div class="sticker text-center mb-6">
              <div>
                  <svg class="w-36 h-20 mx-auto mb-4">
                      <use xlink:href="#certificate_valid"></use>
                  </svg>
                  <h2 class="text-2xl" style="color:var(--color-hover)">گواهینامه معتبر می&zwnj;باشد</h2>
              </div>
              <div style="display: none;">
                  <svg class="w-36 h-20 mx-auto mb-4">
                      <use xlink:href="#certificate_not_valid"></use>
                  </svg>
                  <h2 class="text-2xl" style="color:var(--color-red)">گواهینامه معتبر نمی&zwnj;باشد</h2>
              </div>
          </div>
          <div class="content text-center">
              <p class="mb-3 text-base">شرکت کننده: <strong>${response.data.details.name}</strong></p>
              <p class="mb-3 text-base">نام دوره: <strong>${response.data.details.course_name}</strong></p>
              <p class="text-base">تاریخ صدور: <strong>${response.data.details.date}</strong></p>
          </div>
      </div></div>`
        );
        goToFormCert();
      },
      error: function (error) {
        notice_fixed__toggle("کد اشتباه است ");
      },
    });
  }
}
function sendMobile(formData) {
  jQuery.ajax({
    type: "POST",
    url: ravinacademy_ajax_url,
    data: formData,
    beforeSend: function () {
      // Code to run before the request is sent
      // For example, you can show a loading spinner or disable form elements
      jQuery("#loading").toggleClass("invisible");
      jQuery("#loading").toggleClass("opacity-0");
    },
    success: function (response) {
      jQuery("#form-get-cerf").addClass("invisible");
      jQuery("#form-get-cerf").addClass("opacity-0");
      jQuery("#form-get-cerf").addClass("h-0");

      jQuery("#loading").toggleClass("invisible");
      jQuery("#loading").toggleClass("opacity-0");

      jQuery("#parent-otp-code").html("");
      jQuery("#parent-otp-code").removeClass("invisible");
      jQuery("#parent-otp-code").removeClass("opacity-0");
      jQuery("#parent-otp-code")
        .append(`<div class="bg-white p-6 rounded-2xl form-otp">
        <button onclick="goToFormCert()" class="bg-white p-3 border rounded-full absolute left-4 top-4">
        <svg class="w-3 h-3">
          <use href="#icon-btn-arrow"></use>
        </svg>
        </button>
        <form onsubmit="window.get_certificate_info(this); return false" data-action='confrim_code'>
        <div class="enter-code enter-code-mobile-user flex flex-col gap-6 mb-4">
                    <p>کد را وارد کنید</p>
                    <div class="justify-center otp otp-mobile-user">
                      <input
                        hidden
                        type="number" required=""
                        class="_input-server-code"
                        name="opt_code"
                      />
                      <input type="text"class="otp-code" inputmode="numeric" />
                      <input type="text"class="otp-code" inputmode="numeric" />
                      <input type="text"class="otp-code" inputmode="numeric" />
                      <input type="text"class="otp-code" inputmode="numeric" />
                    </div>
                    <div class="flex items-center justify-center gap-2">
                      <button
                        class="justify-center send-again hidden"
                        style="padding: 10px 5px;"
                        disabled
                      >
                        ارسال مجدد
                      </button>
                      <div class="timer-code"></div>
                    </div>
                  </div>
              <button type="submit" class="w-full justify-center btn primary py-3 btn-submit">تایید</button>
          </form>
          </div>`);
      createOtp(".enter-code-mobile-user");
      createTimer(".timer-code");
      const btnSendAgainElm = document.querySelector(".send-again");
      setTimeout(() => {
        jQuery(".send-again").removeClass("hidden");
        handlerDisable(btnSendAgainElm, false);
      }, 60000);
      btnSendAgainElm.addEventListener("click", (e) => {
        e.preventDefault();
        btnSendAgain();
      });
      jQuery(".form-otp").on("click", (e) => {
        e.stopPropagation();
      });
    },
    error: function (error) {
      jQuery("#loading").toggleClass("invisible");
      jQuery("#loading").toggleClass("opacity-0");

      jQuery("#popup").toggleClass("invisible");
      jQuery("#popup").toggleClass("opacity-0");
      jQuery("#popup").html("");
      error_certificate();
    },
  });
}
function error_certificate() {
  jQuery("#popup").append(
    `<div class="transition bg-white duration-300 z-20 sm:rounded-lg w-full sm:w-auto sm:min-w-[500px]"><div class="p-6 font-medium flex justify-center text-2xl border-b border-gray-500 border-opacity-30">اعتبارسنجی گواهینامه</div><div class="p-6">
      <div class="sticker text-center mb-6">
          <div>
              <svg class="w-36 h-20 mx-auto mb-4">
                  <use xlink:href="#certificate_not_valid"></use>
              </svg>
              <h2 class="text-2xl" style="color:var(--color-red)">گواهینامه معتبر نمی&zwnj;باشد</h2>
          </div>
      </div>
     </div>
    </div>`
  );
}

function btnSendAgain(time = 60000) {
  const form = jQuery(".form-send-mobile");
  let formData = form.serialize(); // Serialize form data
  // Add nonce to formData
  formData += `&action=check_certificate&ravinacademy_nonce=${ravinacademy_nonce}`;

  const btn = document.querySelector(".send-again");
  handlerDisable(btn);
  jQuery(".send-again").addClass("hidden");

  sendMobile(formData);
  setTimeout(() => {
    jQuery(".send-again").removeClass("hidden");
    handlerDisable(btn, false);
  }, time);
}
function handlerDisable(elm, isDisable = true) {
  if (isDisable) elm.setAttribute("disabled", "true");
  else {
    elm.removeAttribute("disabled");
  }
}
function goToFormCert() {
  jQuery("#form-get-cerf").removeClass("invisible");
  jQuery("#form-get-cerf").removeClass("opacity-0");
  jQuery("#form-get-cerf").removeClass("h-0");
  jQuery("#parent-otp-code").removeClass("invisible");
  jQuery("#parent-otp-code").removeClass("opacity-0");
  jQuery("#parent-otp-code").html("");
  if (intervalTimer) clearInterval(intervalTimer);
}

if (document.querySelector(".section-khdamat")) {
  document.addEventListener("DOMContentLoaded", function () {
    var tablinks = document.getElementsByClassName("tablinks");
    for (var i = 0; i < tablinks.length; i++) {
      tablinks[i].addEventListener("click", function () {
        var current = document.getElementsByClassName("active");
        if (current.length > 0) {
          current[0].classList.remove("active");
        }
        this.classList.add("active");
      });
    }
  });
}
