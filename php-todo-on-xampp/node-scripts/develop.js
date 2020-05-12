const fs = require('fs-extra')
const path = require('path')

const configPath = path.join(__dirname, "../config.json")
const srcPath = path.join(__dirname, "../src")

const configJson = require(configPath)
const output_directory = configJson.output_directory

const mirrorSrcToXampp = () => {
  fs.emptyDirSync(output_directory)
  fs.copy(srcPath, output_directory, (err) => {
    if (err) console.log(err)
    else console.log("Mirrored src to " + output_directory)
  })
}

let fsWait = false
fs.watch(srcPath, (event, filename) => {
  if (fsWait) return; //debounce the events
  fsWait = setTimeout(() => {
    fsWait = false;
  }, 100);
  // on windows event is either 'renamed' (for create/delete) or 'change' for (modified)
  // console.log(`${filename} file Changed`);
  mirrorSrcToXampp()
})