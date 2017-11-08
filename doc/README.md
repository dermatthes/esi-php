# EdgeSideIncludes On Speed

## Features

- Parallel loading from sources
- Automatic Asset detection



## Spec (ESI)


### Variables

```
HTTP_ACCEPT_LANGUAGE, 
_COOKIE, 
_HOST, 
_REFERER, 
_USER_AGENT, 
QUERY_STRING
```


Using Variables
```
$(VARNAME{index})
$(VARNAME{index}|default)
```


### Includes

```
<esi:include src="http://someUrl" alt="" onerror="" maxwait="" />
```


### Choose

```
<esi:choose>
  <esi:when test="BOOLEAN_expression">
    Perform this action
  </esi:when>
  <esi:when test="BOOLEAN_expression">
    Perform this action
  </esi:when>
  <esi:otherwise>
    Perform this other action
  </esi:otherwise>
</esi:choose>
```


### Try/Catch

```
<esi:try>
  <esi:attempt>
    Try this...
  </esi:attempt>
  <esi:except [type="type"]>
    If the attempt fails, then perform this action...
  </esi:except>
  <esi:except [type="type"]>
    Perform this action...
  </esi:except>
  <esi:except>
    If the attempt fails, then perform this action...
  </esi:except>
</esi:try>
```


### Vars

```
<esi:vars>Code with $(VARNAME{key}) substitution</esi:vars>
```

### Esi-Remove

```
<esi:remove>Code to be displayed if ESI could not be rendered</esi:remove>
```


## Extended Syntax

### Templates

Render the actual content inside another Template

```
<esi:render-in src="" alt="" timeout="">

</esi:render-in>
```

in the Template you can use

```
<esi:output/>
```

### Assets

Rewrite href and src attributes inside the container

```
<esi:assets>
</esi:assets>
```

Replace Relative urls (`src`, `href`) by `/_asset/HASH(URL,REVISON)/relative/path/to.css`


### Markdown

```
<esix:markdown>
# Some Header

Some Markdown content here
</esix:markdown>
```



### Flush

Flush buffered content. Caution: No headers can be modified
afterwards.

```
<esix:flush/>
```

### CSRF-Token

```
<esi:x-csrf-token/>
```

Will print a `<input type="hidden" name="csrftoken" value="hiddenValue">`

Backend-Services can determine the token (AJAX) from the default-header `X-CSRFTOKEN`

The framework will reject requests (Except `GET`) without this token set:

```
_POST[csrftoken]
_HEADER[X-Csrf-Token]
_HEADER[X-XSRF-TOKEN]       Angular
_HEADER[X-Requested-With] 	jQuery
_HEADER[X-Requested-By]     Jearsy
```


## Howto


### Automatic Asset Redirection

Each file rendered will be cached with its location in redis cache.

All URLs (`src=` to relative path will be rewritten to the original
URL:

```
https://githubusercontent.com/someuser/raw/
```


> Planned for next version:
> Rewrite the stuff to local proxy
> ```
> \_asset\X73jj4BDDQ\relative.png
> ```



