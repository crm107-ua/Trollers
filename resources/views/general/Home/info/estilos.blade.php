<style>
.center {
  margin: auto;
}
.table {
  width: 98%;
  height: 100px;
}
.table .monitor-wrapper .monitor {
  overflow: hidden;
  white-space: nowrap;
}
.table .monitor-wrapper .monitor p {
  font-family: "VT323", monospace;
  font-size: 30px;
  position: relative;
  display: inline-block;
  animation: move 20s infinite linear;
}
@keyframes move {
  from {
    left: 1000px;
  }
  to {
    left: -2800px;
  }
}
</style>