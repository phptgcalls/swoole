<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl;

use function Amp\File\openFile;

class Builder {
	private int $indents;
	private int $indentSize;
	private object $outStream;
	private string $text;

	public function __construct(string $filename,int $indentSize = 1){
		$this->indents = 0;
		$this->indentSize = $indentSize;
		$this->outStream = openFile($filename,'w+');
		$this->text = (string) null;
	}
	public function indent() : string {
		return str_repeat(chr(9),$this->indents * $this->indentSize);
	}
	public function addIndent(int $count = 1) : void {
		$this->indents = max($this->indents + $count,0);
	}
	public function deleteIndent(int $count = 1) : void {
		$this->indents = max($this->indents - $count,0);
	}
	public function write(string $string) : void {
		$this->outStream->write($string);
	}
	public function writeNewLine(? string $string = null) : void {
		$this->text .= is_null($string) ? chr(10) : chr(10).$this->indent().$string;
	}
	public function writeDocComment(mixed ...$doc) : void {
		$this->writeNewLine('/**');
		foreach($doc as $name => $value):
			$this->writeNewLine(' * @'.$name.chr(32).(is_array($value) ? implode(chr(32),$value) : strval($value)));
		endforeach;
		$this->writeNewLine(' */');
	}
	public function close() : void {
		if(empty($this->text) === false) $this->write($this->text);
		$this->outStream->close();
	}
	public function __toString(){
		$this->outStream->seek(SEEK_SET);
		return $this->outStream->read();
	}
	public function __destruct(){
		$this->text = (string) null;
	}
}

?>